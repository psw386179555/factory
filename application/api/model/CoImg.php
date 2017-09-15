<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 17:40
 */

namespace app\api\model;


class CoImg extends Base
{
    protected $visible=['img'];

    public function saveCoImg($coID,$imgID)
    {
        return self::create([
            'co_id'=>$coID,
            'img_id'=>$imgID
        ]);
    }

    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}