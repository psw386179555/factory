<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 14:13
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code=400;
    public $msg='params error';
    public $errorCode=10000;
}