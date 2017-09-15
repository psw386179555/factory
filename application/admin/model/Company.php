<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/3
 * Time: 15:53
 */

namespace app\admin\model;




class Company extends Base
{
    public function submitMan()
    {
        return $this->belongsTo('Member','submit_openid','openid');
    }

    public function getCompanyList()
    {
        $res=self::with(['submitMan'])->select();
        return $res;
    }

    public function getStatusAttr($value)
    {
        $status = [0=>'不通过',1=>'待审核',2=>'通过'];
        return $status[$value];
    }


}