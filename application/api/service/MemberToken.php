<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 10:34
 */

namespace app\api\service;
use app\api\model\Member as MemberModel;

use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class MemberToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppId,$this->wxAppSecret,$this->code);

    }

    public function get()
    {
        $res = curl_get($this->wxLoginUrl);
        $arrRes = json_decode($res ,true);
        if (empty($arrRes)){
            throw new Exception("get session_key and openid error ,wechat error");
        }
        else{
            $loginFail = array_key_exists('errcode',$arrRes);
            if ($loginFail){
                $this->loginError($arrRes);
            }
            else{
                return $token = $this->grantToken($arrRes);
            }

        }


    }
    private function grantToken($arrRes)
    {
        $openid  = $arrRes['openid'];
        $member = MemberModel::getByOpenID($openid);
        if ($member){
            $mid =$member->id;

        }
        else{
            $mid = $this->newMember($openid);
        }

        $cacheValue = $this->prepareCacheValue($arrRes,$mid);
        $token = $this->saveToCache($cacheValue);

        return $token;


    }

    private function saveToCache($cacheValue)
    {
        $key =self::generateToken();
        $value = json_encode($cacheValue);

        $expire_in = config('myconfig.token_expire_in');

        $request = cache($key,$value,$expire_in);

        if (!$request){
            throw new TokenException([
                'msg'=>'service cache error',
                'errorCode'=>10005
            ]);
        }
        return $key;

    }


    private function prepareCacheValue($arrRes,$mid)
    {
        $cacheValue=$arrRes;
        $cacheValue['mid'] = $mid;
        $cacheValue['scope'] = ScopeEnum::User;
        return $cacheValue;
    }

    private function newMember($openid)
    {
        $member = MemberModel::create([
           'openid' => $openid,
        ]);
        return $member->id;
    }

    private function loginError($arrRes)
    {
        throw new WeChatException([
           'msg'=>$arrRes['errmsg'],
           'errorCode'=>$arrRes['errcode']
        ]);
    }
}