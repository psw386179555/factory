<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 11:27
 */

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\service\Banner as BannerService;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;

class Banner extends BaseController
{
    protected $beforeActionList=[
        'checkSuperExclusiveScope'=>['only'=>'changeBannerStatus,saveOrUpdateBanner']
    ];
    /**
     * @param $id 指定banner图组的id
     * @return 返回首页banner图
     * @throws BannerMissException
     */
    public function getBanner()
    {

        $banner = BannerModel::getBanner();

        if (!$banner){
            throw new BannerMissException();
        }else{
            return $banner;
        }

    }
    /**
     * 第三方app获取所有Banner
     */

    public function getAllBanner($page,$rows,$sort,$order)
    {
        $res = (new BannerModel())->getAllBanner($page,$rows,$sort,$order);
        return $res;
    }
    /**
     * 第三方添加banner
     */

    public function saveOrUpdateBanner()
    {
        $bannerService = new BannerService();
        $banner_id =  $bannerService->addBanner();
        $res =  $bannerService->addBannerItem($banner_id);
        return $res;
    }

    public function changeBannerStatus($id,$status)
    {
        (new IDMustBePositiveInt())->goCheck();

        $res = (new BannerModel())->changeStatus($id,$status);

        return $res;
    }
}
