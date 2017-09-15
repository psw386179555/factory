<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 10:33
 */

namespace app\api\model;


use think\Exception;

class Member extends Base
{
    public static function getByOpenID($openid)
    {
       $member = self::where('openid','=',$openid)->find();
       return $member;
    }


    public function addMember($mid){
        $data = request()->post();
        $data['auth'] = 1;
        $res = self::save($data,['id'=>$mid]);
        return $data['auth'];
    }

    public function addVerify($mid)
    {
        $data = request()->post();
        $res = self::save($data,['id' => $mid]);
        return $res;


    }

    public function findMember($mid)
    {
        $res = self::get($mid);

        return $res;

    }

    public function getAllMember($page,$rows,$status)
    {
        $map = [];

        if ($status!=''){
            $map['status'] = $status;
        }

        $res = self::where($map)->paginate($rows,true,['page'=>$page])->all();
        $total = self::where($map)->count();

        $arr['total']= $total;
        $arr['rows'] = $res;
        return $arr;
    }

    public function updateMember()
    {
        $data =request()->post();


        $id = $data['id'];

        unset($data['id']);

        $res = self::update($data,['id'=>$id]);

        return $res;
    }


}