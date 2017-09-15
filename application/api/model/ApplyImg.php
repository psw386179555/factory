<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/18
 * Time: 10:39
 */

namespace app\api\model;


class ApplyImg extends  Base
{
    protected $visible=['img'];

    public function saveApplyImg($applyID,$imgID)
    {
        return self::create([
            'apply_id'=>$applyID,
            'img_id'=>$imgID
        ]);
    }

    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}