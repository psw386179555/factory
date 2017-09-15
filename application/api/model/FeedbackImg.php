<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/31
 * Time: 15:01
 */

namespace app\api\model;


class FeedbackImg extends Base
{
    public static function addFeedbackImg($feedbackID,$imgID)
    {
        return self::create([
            'feedback_id'=>$feedbackID,
            'img_id'=>$imgID
        ]);
    }
}