<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/22
 * Time: 14:30
 */

namespace app\api\service;
use app\api\model\Apply as ApplyModel;
use app\api\model\ApplyImg;
use think\Db;
use think\Exception;

class Apply
{
    public static function saveApply($mid)
    {
        try {
            Db::startTrans();
            $data = request()->post();
            $data['mid'] = $mid;
            $data['send_time'] = strtotime($data['send_time']);
            $data['status'] = 1;
            $photos = $data['photos'];
            unset($data['photos']);
            $apply = new ApplyModel();
            $res = $apply->addApply($data);
            $applyID = $res->id;
            $photos = explode(',', $photos);
            foreach ($photos as $imgID) {
                $applyImg = new ApplyImg();
                $applyImg->saveApplyImg($applyID, $imgID);
            }
            Db::commit();
            return true;
        }catch (Exception $e){
            Db::rollback();
        }
    }
}