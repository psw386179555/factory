<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 12:09
 */

namespace app\api\model;


use app\api\validate\IDMustBePositiveInt;

class Banner extends Base
{
    protected $visible=['id','title','item','status'];
    public function item()
    {
        return $this->hasMany('BannerItem','banner_id','id')->where('status','eq',1);
    }


    public static function getBanner()
    {
        return self::with('item,item.img')->where('status','eq',1)->find();
    }

    public function getAllBanner($page,$rows,$sort,$order)
    {
        $res = self::with('item,item.img')
            ->order($sort,$order)
            ->paginate($rows,true,['page'=>$page])
            ->all();
        $total = self::count();

        $arr['total']= $total;
        $arr['rows'] = $res;

        return $arr;
    }

    public  function saveOrUpdateBanner($data)
    {

        if (array_key_exists('id',$data)){
            $id = $data['id'];
            unset($data['id']);
            $res = self::update($data,['id'=>$id]);
            return $res;
        }else{
            $res = self::create($data);
            return $res->id;
        }
    }

    public function changeStatus($id,$status)
    {
        $res = self::update([ 'status'=>$status],[
            'id'=>$id
        ]);
        return $res;
    }
}