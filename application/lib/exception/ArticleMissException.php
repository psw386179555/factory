<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/4
 * Time: 12:16
 */

namespace app\lib\exception;


class ArticleMissException extends BaseException
{
    public $code=404;
    public $msg = 'article miss';
    public $errorCode = 40001;
}