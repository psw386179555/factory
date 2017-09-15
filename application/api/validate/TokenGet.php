<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 10:27
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule=[
        'code' => 'require|isNotEmpty'
    ];

    protected  $message = [
        'code' => 'no token'
    ];




}