<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 18:39
 */

namespace app\admin\validate;

use think\Request;

use think\Validate;

class BaseValidate extends Validate
{
    public function checkParams()
    {
        $request = Request::instance();

        $params = $request->param();

        $result=$this->batch()->check($params);

        return $this->error;
    }

}