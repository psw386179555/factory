<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/1
 * Time: 16:05
 */

namespace app\admin\controller;


use think\Cache;

class Base
{
    public function clearCache()
    {
        $data=Cache::clear();


        if ($data) {
            return json(['msg'=>'清除成功！']);
        }else{
            return json(['msg'=>'清除失败！请重试']);
        }

    }
}