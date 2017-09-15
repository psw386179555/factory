<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 15:38
 */

namespace app\lib\exception;


class CoMissException extends BaseException
{
    public $code = 404;
    public $msg = "company miss";
    public $errorCode = 40002;
}