<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/9/1
 * Time: 13:20
 */

namespace app\api\service;
use app\api\model\CoImg;
use app\api\service\Token as TokenService;
use app\api\model\Company as CompanyModel;
use think\Db;
use think\Exception;

class Company
{
    public static function addCo()
    {
        $data = request()->post();

        $mid = TokenService::getCurrentMid();

        $data['mid'] =  $mid;

        try{
            Db::startTrans();
            $photos = $data['photos'];
            $data['status'] = 1;
            unset($data['photos']);
            $company = new CompanyModel();
            $res = $company->addCo($data);
            $coID = $res->id;
            $photos = explode(',',$photos);
            foreach ($photos as $imgID){
                $coImg = new CoImg();
                $coImg ->saveCoImg($coID,$imgID);
            }
            Db::commit();
            return true;
        }catch (Exception $e){
            Db::rollback();
            return false;
        }


    }
}