<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/31
 * Time: 14:59
 */

namespace app\api\model;


class Feedback extends Base
{
    public function addFeedback($data)
    {
        $res = self::create($data);
        return $res;
    }
}