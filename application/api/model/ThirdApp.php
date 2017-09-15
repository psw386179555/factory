<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/22
 * Time: 10:48
 */

namespace app\api\model;




class ThirdApp extends Base
{
    public static function check($ac,$se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret','=',$se)
            ->find();
        return $app;
    }
}