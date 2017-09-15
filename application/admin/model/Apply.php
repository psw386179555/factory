<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/19
 * Time: 21:05
 */

namespace app\admin\model;


class Apply extends Base
{
    public function getList($status)
    {
        return self::all([
            'status'=>$status
        ]);
    }

    public function getTypeAttr($value)
    {
        $Type = [0=>'成果转化',1=>'机械加工'];
        return $Type[$value];

    }

    public function getStatusAttr($value)
    {
        $status = [0=>'不通过',1=>'待审核',2=>'通过'];
        return $status[$value];
    }
}