<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 15:22
 */

namespace app\admin\controller;


use app\admin\model\BannerItem;
use think\Request;

use app\admin\model\Banner as BannerModel;

class Banner extends Auth
{

    //初始化banner页面信息
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','轮播管理');
        $this->assign('tab','banner');//控制左边tab显示
    }


    //显示后台banner页面
    public function index()
    {
        $article=new BannerModel;
        $res=$article->getBanner();

        $this->assign('banner',$res);

        return $this->fetch();
    }

    //新增banner
    public function add()
    {
        if (Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['status']=1;
            $banner = new BannerModel();
            $res=$banner->add($data);
            if ($res){
                return json(['code'=>1,'msg'=>'添加成功！','data'=>$res]);
            }else{
                return json(['code'=>0,'msg'=>'添加失败！']);
            }

        }else{
            $id = request()->param('id');
            $this->assign('banner_id',$id);
            return $this->fetch();
        }
    }

    public function change($status,$id)
    {
        if ($status == '禁用'){
            $status = 1;
        }else{
            $status = 0;
        }

        $res = (new BannerModel())->change($status,$id);

        $this->redirect('index');

    }

    public function addItem()
    {
        if (Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['status']=1;
            $banner = new BannerItem();
            $res=$banner->add($data);
            return $res;

        }else{
            $id = request()->param('id');
            $this->assign('banner_id',$id);
            return $this->fetch('banner/add');
        }
    }

}