<?php
// +----------------------------------------------------------------------
// | 青春博客 thinkphp5 版本
// +----------------------------------------------------------------------
// | Copyright (c) 2013~2016 http://loveteemo.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: long <admin@loveteemo.com>
// +----------------------------------------------------------------------
namespace app\admin\model;

class Banner extends Base
{

    protected $hidden=['del_time'];


	public function add($data)
	{
		$res = $this->isUpdate(false)->save($data);
		return $res;
	}



    public function item()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }


    public function getBanner()
    {
        $banner =Banner::all();
        return $banner;
    }

    public function change($status,$id)
    {
        $res = self::update([
            'status'=>$status
        ],[
            'id'=>$id
        ]);
        return $res;
    }

}