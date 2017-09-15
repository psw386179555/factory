<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/31
 * Time: 14:58
 */

namespace app\api\controller\v1;
use app\api\service\Token as TokenService;
use app\api\service\Feedback as FeedbackService;
class Feedback
{
    public function addFeedback()
    {
        $mid = (new TokenService())->getCurrentMid();

        $res = FeedbackService::addFeedback($mid);

        return $res;

    }
}