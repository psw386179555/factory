<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 10:42
 */

namespace app\admin\controller;


use app\admin\validate\VarcharValidate;
use think\Controller;
use app\admin\model\Login as LoginModel;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        $session = Session::has('userinfo');
        if ($session){
            $this->redirect('admin/index/index');
        }else{
            $this->assign('title','管理登录');
            return $this->fetch();
        }

    }

    /**
     * 登录后台
     */

    public function login($username,$password)
    {

        (new VarcharValidate())->checkParams();
        $login=new LoginModel();
        $res = $login->checkLogin($username,$password);
        if($res){
            Session::set('userinfo',$res);
            return json('登录成功');
        }else{
            return json('登录失败',400);
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('userinfo');
        return json(['code'=>1,'msg'=>'退出成功']);
    }
}