<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 12:43
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //http状态码
    public $code=400;
    //错误信息
    public $msg='params error';
    //
    public $errorCode=10000;

    public function __construct($params = [])
    {
        if (!is_array($params)){
            return '';
        }

        if (array_key_exists('code',$params)){
            $this->code=$params['code'];
        }

        if (array_key_exists('msg',$params)){
            $this->msg=$params['msg'];
        }

        if (array_key_exists('errorCode',$params)){
            $this->errorCode=$params['errorCode'];
        }
    }
}