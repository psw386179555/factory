<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/1
 * Time: 12:35
 */

namespace app\admin\model;


class Upload extends Base
{
    protected $table="sw_image";
    protected $hidden=['del_time','id','ctime'];


    public function saveImg($path)
    {
        $upload=new Upload();
        $upload->data(['img_url'=>$path]);
        $res = $upload->save();
        return $upload->id;
    }

}