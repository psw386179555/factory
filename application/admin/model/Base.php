<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/3
 * Time: 8:43
 */

namespace app\admin\model;


use think\Model;

class Base extends Model
{

    public function getStatusAttr($value)
    {
        $status = [0=>'禁用',1=>'正常'];
        return $status[$value];
    }



}