<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 15:12
 */

namespace app\admin\controller;
use app\admin\model\Member as MemberModel;
use think\Request;
use think\Session;

class Member extends Auth
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','用户管理');
        $this->assign('tab','member');//控制左边tab显示
    }

    public function index()
    {
        $member=new MemberModel();
        $res = $member->getUserList();
        $this->assign('member',$res);
        return $this->fetch();
    }

    public function check($id)
    {
        $member=new MemberModel();
        $res = $member->check($id,2);
        $this->redirect('member/index');

    }

    public function uncheck($id)
    {
        $member=new MemberModel();
        $res = $member->check($id,0);
        $this->redirect('member/index');
    }

    public function info(){
        return $this->fetch();
    }

    public function changeMyInfo(){
        $id = Session::get('userinfo.id');
        $member=new MemberModel();
        $res = $member->changeMyinfo($id);
        return json($res);
    }
}