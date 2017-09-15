<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 10:25
 */

namespace app\api\controller\v1;
use app\api\service\AppToken;
use app\api\service\Token as TokenService;

use app\api\service\MemberToken;
use app\api\validate\AppTokenGet;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;

class Token
{
    public function getToken($code)
    {
        (new TokenGet()) -> goCheck();
        $mt = new MemberToken($code);
        $token = $mt ->get();
        return [
          'token' => $token
        ];
    }

    /**
     * post
     * @param string $ac
     * @param string $se
     * @return array
     */

    public function getAppToken($ac='',$se=''){
        (new AppTokenGet())->goCheck();
        $se = md5($se);
        $app = new AppToken();
        $token = $app ->get($ac,$se);
        return  [
            'token' =>$token
        ];

    }

    public function verifyToken($token='')
    {
        if(!$token){
            throw new ParameterException([
               'token can not be null'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }
}