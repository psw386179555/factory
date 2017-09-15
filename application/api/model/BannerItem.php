<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/4
 * Time: 9:46
 */

namespace app\api\model;


class BannerItem extends Base
{
    protected $visible=['title','article','img'];
    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }

    public static function addBannerItem($data)
    {
        $res =(new BannerItem())->saveAll($data);
        return $res;
    }
}