<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/14
 * Time: 15:00
 */

namespace app\admin\model;


class BannerItem extends Base
{
    protected $hidden=['id','img_id','ctime','del_time','banner_id','article_id'];

    public function img()
    {
        return $this->belongsTo('Upload','img_id','id');
    }


    public function article()
    {
        return $this->belongsTo('Article','article_id','id');
    }

    public function add($data)
    {
        return self::isUpdate(false)->save($data);
    }

    public function getItem($id)
    {
        return self::all(['banner_id'=>$id]);
    }

    public function change($status,$id)
    {
        $res = self::update([
            'status'=>$status
        ],[
            'id'=>$id
        ]);
        return $res;
    }
}