<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 17:29
 */

namespace app\admin\controller;
use app\admin\logic\Login as LoginLogic;
use think\Controller;
use think\Session;

class Auth extends Controller
{
    /**
     * 验证授权
     */
    public function _initialize()
    {
        $session = Session::has('userinfo');
        if (!$session){
            $this->redirect('admin/login/index');
        }

    }

}