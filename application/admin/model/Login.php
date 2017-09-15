<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 18:47
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Login extends Model
{
    public function checkLogin($username,$password)
    {
        $res=Db::table('sw_member')->where('username',$username)->find();
        if ($res['password']==$password){
            return $res;
        }else{
            return false;
        }
    }

}