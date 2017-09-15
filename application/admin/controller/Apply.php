<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 15:17
 */

namespace app\admin\controller;

use app\admin\model\Apply as ApplyModel;


class Apply extends Auth
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','申请管理');
        $this->assign('tab','apply');//控制左边tab显示
    }

    public function index()
    {
        $apply = new ApplyModel();
        $res0 = $apply->getList(0);
        $res1 = $apply->getList(1);
        $res2 = $apply->getList(2);
        $this->assign('apply0',$res0);
        $this->assign('apply1',$res1);
        $this->assign('apply2',$res2);
        return $this->fetch();
    }
}