<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/22
 * Time: 10:46
 */

namespace app\api\service;


use app\api\model\ThirdApp;
use app\lib\exception\TokenException;

class AppToken extends Token
{
    public function get($ac,$se)
    {
        $app = ThirdApp::check($ac,$se);
        if (!$app){
            throw new TokenException([
                'msg' => '授权失败',
                'errorCode' => 10004
            ]);
        }else{
            $scope = $app->scope;
            $mid = $app->id;
            $value = [
                'scope' => $scope,
                'mid' => $mid
            ];
            $token = $this->saveToCache($value);
            return $token;
        }
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
}