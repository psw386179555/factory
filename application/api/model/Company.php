<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 15:16
 */

namespace app\api\model;


use app\lib\exception\AddCoException;
use think\Exception;
use think\Request;
use app\api\model\CoImg as img;

class Company extends Base
{
    protected $hidden=['delete_time','update_time','mid'];

    public function getCoByMid($id)
    {
       $res = self::all([
           'mid'=>$id,
        ]);
        return $res;
    }

    public function item()
    {
        return $this->hasMany('CoImg','co_id','id');
    }
    public function logo()
    {
        return $this->belongsTo('Image','logo','id');
    }

    public function showCoByCoId($id)
    {
        $res= self::with(['item','logo','item.img'])->find($id);
        return $res;
    }

    public function getCoListByStatus()
    {
        $res = self::all([
            'status'=>2,
        ]);
        return $res;
    }



    /**
     *添加企业
     */
    public function addCo($data)
    {
      $res = self::create($data);
      return $res;
    }

    public function getAllCompany($page,$rows,$status)
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

    public function updateCompany()
    {
        $data =request()->post();


        $id = $data['id'];

        unset($data['id']);

        $res = self::update($data,['id'=>$id]);

        return $res;
    }
}