<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 15:16
 */

namespace app\api\controller\v1;
use app\api\model\Company as CompanyModel;
use app\api\service\Token as TokenService;

use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\CoMissException;
use app\api\service\Company as CompanyService;
class Company extends BaseController
{
    protected $beforeActionList = [
        'checkSuperExclusiveScope' => ['only' => 'saveOrUpdateCompany']
    ];
    /**
     * 根据用户id获取对应的入驻企业
     * @param $id
     * @return false|static[]
     */
    public function getCoByToken()
    {
       $mid = TokenService::getCurrentMid();

       $res = (new CompanyModel())->getCoByMid($mid);

       $res->visible(['id','name','status']);
       if ($res->isEmpty()){
           throw new CoMissException();
       }else{
           return $res;
       }

    }

    public function showCoByCoId($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $companyModel =  new CompanyModel();
        $res = $companyModel->showCoByCoId($id);
        if (!$res){
            throw new CoMissException();
        }else{
            return $res;
        }
    }

    public function getCoListByStatus()
    {
        $companyModel =  new CompanyModel();
        $res = $companyModel->getCoListByStatus();

        $res->visible(['id','name','update_time']);
        if ($res->isEmpty()){
            throw new CoMissException();
        }else{
            return $res;
        }
    }

    public function addCo()
    {
        $res = CompanyService::addCo();
        return $res;
    }

    /**
     *第三方app获取公司列表CMS
     */
    public function getAllCompany($page,$rows,$status='')
    {
        $res = (new CompanyModel())->getAllCompany($page,$rows,$status);
        return $res;
    }

    /**
     * 第三方app更新
     */
    public function saveOrUpdateCompany()
    {
        $res = (new CompanyModel())->updateCompany();
        return $res;
    }


}