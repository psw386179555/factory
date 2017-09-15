<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/18
 * Time: 9:45
 */

namespace app\api\model;


use app\lib\exception\ApplyException;
use think\Exception;

class Apply extends Base
{
    protected $hidden=['delete_time'];

    public function addApply($data)
    {
        $res = self::create($data);
        return $res;
    }

    public function applyList($mid)
    {
        $res = self::all(['mid'=>$mid]);
        return $res;
    }

    /**
     * 第三方app获取所有申请
     */
    public static function getAllApply($page,$rows,$status)
    {
        $map = [];
        if ($status!=''){
            $map['status'] = $status;
        }

        $res = self::where($map)->paginate($rows,true,['page'=>$page])->all();
        $arr['total'] = self::where($map)->count();
        $arr['rows'] = $res;

        return $arr;
    }

    public static function saveOrUpdateApply()
    {
        $data = request()->post();

        if (array_key_exists('id',$data)){
            $id = $data['id'];
            unset($data['id']);
            $res = self::update($data,['id'=>$id]);
            return $res;
        }else{
            $res = self::save($data);
        }
    }

    public function getSendTimeAttr($value)
    {
        return date('Y-m-d',$value);
    }
}