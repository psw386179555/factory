<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/4
 * Time: 9:08
 */

namespace app\api\model;


use think\Config;

class Image extends Base
{
    protected $visible=['img_url'];

    public function getImgUrlAttr($value)
    {
        return Config::get('myconfig.img_prefix').$value;
    }

    public function saveImage($path)
    {
        $img = self::create([
            'img_url'=>$path
        ]);

        return $img->id;
    }



}