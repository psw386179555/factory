<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/22
 * Time: 14:33
 */

namespace app\api\validate;


class ApplyAdd extends BaseValidate
{
    protected $rule = [
        'content' => 'require|isNotEmpty',
        'type' => 'require|isNotEmpty',
        'leader' => 'require|isNotEmpty',
        'mobile' => 'require|isNotEmpty',
        'project_name' => 'require|isNotEmpty',
        'money' => 'require|isNotEmpty',
    ];
}