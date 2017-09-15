<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/9/1
 * Time: 17:04
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    //http状态码
    public $code=403;
    //错误信息
    public $msg='permission denied';
    //
    public $errorCode=10001;
}