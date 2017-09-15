<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 12:26
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        $randChars = getRandChars(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        $salt = config('secure.token_salt');



        return md5($randChars.$timestamp.$salt);
    }

    public static function verifyToken($token)
    {
        $exist = Cache::get($token);

        if ($exist){
            return true;
        }else{
            return false;
        }
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);

        if (!$vars){
            throw new TokenException();
        }else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('the token missing');
            }

        }


    }

    public static function getCurrentMid()
    {
        $mid = self::getCurrentTokenVar('mid');
        return $mid;
    }

    //用户和管理员都可以访问
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if($scope >= ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }

    //只有用户可以访问
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if($scope == ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }

    //只有用户可以访问
    public static function needSuperExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if($scope == ScopeEnum::Super){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }
}