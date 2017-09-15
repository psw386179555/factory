<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 15:13
 */

namespace app\admin\controller;
use app\admin\model\Company as CompanyModel;


class Company extends Auth
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','入驻工厂管理');
        $this->assign('tab','company');//控制左边tab显示
    }

    public function index()
    {
        $company = new CompanyModel();
        $res = $company->getCompanyList();
        $this->assign('company',$res);
        return $this->fetch();
    }

    public function companyList()
    {
        $company = new CompanyModel();
        $res = $company->getCompanyList();
        if ($res){
            return json(['code'=>0,'msg'=>'查询成功！','data'=>$res]);
        }else{
            return json(['code'=>1,'msg'=>'查询失败！','data'=>$res]);
        }
    }
}