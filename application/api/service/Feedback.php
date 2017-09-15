<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/31
 * Time: 15:04
 */

namespace app\api\service;
use app\api\model\Feedback as FeedbackModel;
use app\api\model\FeedbackImg;
use think\Db;
use think\Exception;

class Feedback
{
    public static function addFeedback($mid)
    {
        try {
            Db::startTrans();
            $data = request()->post();
            $data['mid'] = $mid;
            $photos = $data['photos'];
            unset($data['photos']);
            $feedback = new FeedbackModel();
            $res = $feedback->addFeedback($data);
            $feedbackID = $res->id;
            $photos = explode(',', $photos);
            foreach ($photos as $imgID) {
                FeedbackImg::addFeedbackImg($feedbackID, $imgID);
            }
            Db::commit();
            return true;
        }catch (Exception $e){
            Db::rollback();
        }
    }
}