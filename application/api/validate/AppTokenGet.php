<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/22
 * Time: 10:44
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
        protected $rule = [
          'ac' => 'require|isNotEmpty',
          'se'=> 'require|isNotEmpty'
        ];

}