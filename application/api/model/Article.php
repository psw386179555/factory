<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/4
 * Time: 11:40
 */

namespace app\api\model;


class Article extends Base
{
    protected $hidden=['update_time','delete_time','img_id'];

    public static function getArticleByID($id)
    {
        $res = self::with('img')->find($id);
        return $res;
    }

    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }

    public static function getArticleList()
    {
        $res = self::with('img')->select(function($query){
            $query->where('type','NEQ',3)->where('status','EQ',1)->order('create_time','desc');
        });
        return $res;
    }

    public static function getNoticeList()
    {
        $res = self::with('img')->select(function($query){
            $query->where('type','EQ',3)->where('status','EQ',1)->order('create_time','desc');
        });
        return $res;
    }

    public static function getAllArticle($page,$rows,$status,$sort,$order)
    {
        $map = [];

        if ($status!=''){
            $map['status'] = $status;
        }

        $res = self::with('img')->where($map)->order($sort,$order)->paginate($rows,true,['page'=>$page])->all();
        $total = self::where($map)->count();

        $arr['total']= $total;
        $arr['rows'] = $res;

        return $arr;
    }
    public static function saveOrUpdateArticle()
    {
        $data = request()->post();

        if (array_key_exists('id',$data)){
            $id = $data['id'];
            unset($data['id']);
            $res = self::update($data,['id'=>$id]);
            return $res;
        }else{
            $res = self::create($data);
        }
    }

}