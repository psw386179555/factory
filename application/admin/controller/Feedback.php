<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/3
 * Time: 15:52
 */

namespace app\admin\controller;


class Feedback extends Auth
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','反馈管理');
        $this->assign('tab','feedback');//控制左边tab显示
    }

    public function index()
    {
        return $this->fetch();
    }
}