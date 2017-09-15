<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 19:11
 */

namespace app\admin\model;


use think\Request;

class Member extends Base
{
   public function img()
   {
       return $this->belongsTo('Upload','img_id','id');
   }

   public function check($id,$status)
   {
       $res = self::update([
           'status' => $status
       ],[
           'id' => $id
       ]);
       return $res ;
   }

   public function delUser($id)
   {
       $res = Member::destroy($id);
       return $res;
   }

   public function changeMyinfo($id){
       $request = Request::instance();
       $data = $request->param();
       $member = new Member();
       $res = $member->save($data,['id' =>$id]);
       return $res;
   }

    public function getUserList()
    {
        $res=self::with(['img'])->select();
        return $res;
    }


    public function getAuthAttr($value)
    {
        if(!empty($value)){
            $type = [0=>'未审核',1=>'已审核'];
            return $type[$value];
        }

    }
    public function getSexAttr($value)
    {
        if(!empty($value)) {

            $type = [0 => '未知', 1 => '男', 2 => '女'];
            return $type[$value];
        }
    }

    public function getStatusAttr($value)
    {
        if(!empty($value)) {
            $status = [0 => '不通过', 1 => '审核中', 2 => '通过'];
            return $status[$value];
        }else{
            return '未登录';
        }
    }
}