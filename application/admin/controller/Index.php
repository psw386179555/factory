<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 10:10
 */

namespace app\admin\controller;


use think\Session;

class Index extends  Auth
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','控制台');
        $this->assign('tab','index');//控制左边tab显示
    }

    public function index()
    {

        return $this->fetch();
    }

}