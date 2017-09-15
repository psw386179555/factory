<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 18:38
 */

namespace app\admin\validate;



class VarcharValidate extends BaseValidate
{

        protected $rule=[
            'username'=>'require',
            'password'=>'require'
        ];


}