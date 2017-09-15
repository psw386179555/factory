<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/19
 * Time: 17:41
 */

namespace app\admin\controller;
use app\admin\model\BannerItem as ItemModel;
use think\Request;

class Banneritem extends Auth
{

    //初始化banner页面信息
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','添加轮播');
        $this->assign('tab','banner');//控制左边tab显示
    }


    public function index()
  {
      if (Request::instance()->isPost()){
          $data=Request::instance()->param();
          $data['status']=1;
          $banner = new ItemModel();
          $res=$banner->add($data);
          return $res;
      }else{
          $id = request()->param('id');
          $banner = new ItemModel();
          $item = $banner->getItem($id);
          $this->assign('item',$item);
          $this->assign('banner_id',$id);
          return $this->fetch();
      }
  }

    public function change($status,$id,$banner_id)
    {
        if ($status == '禁用'){
            $status = 1;
        }else{
            $status = 0;
        }

        $res = (new ItemModel())->change($status,$id);

        $this->redirect('index',['id'=>$banner_id]);

    }
}