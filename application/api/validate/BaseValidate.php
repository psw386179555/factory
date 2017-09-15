<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 11:42
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取参数
        //校验参数
        $request = Request::instance();

        $params = $request->param();

        $result=$this->batch()->check($params);

        if(!$result){
            $e = new ParameterException([
                'msg'=>$this->error
            ]);
            throw $e;
        }
        else{
            return true;
        }
    }

    protected function isPositiveInteger($value,$rule='',$data='',$field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    protected function isNotEmpty($value,$rule='',$data='',$field='')
    {
        if (empty($value))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}