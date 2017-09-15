<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/25
 * Time: 10:30
 */

namespace app\api\service;
use app\api\model\Banner as BannerModel;
use app\api\model\BannerItem as BannerItemModel;
class Banner
{
    public function addBanner()
    {
        $post = request()->post();
        $data['title']= $post['title'];
        $data['status'] = $post['status'];
        $banner_id =(new BannerModel)->saveOrUpdateBanner($data);

        return $banner_id;
    }

    public function addBannerItem($banner_id)
    {
        $post = request()->post();
        $data = $post['item'];
        foreach ($data as $k => $v){
            $data[$k]['status'] = 1;
            $data[$k]['banner_id'] = $banner_id;
        }
        return BannerItemModel::addBannerItem($data);
    }
}