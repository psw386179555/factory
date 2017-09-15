<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/1
 * Time: 15:01
 */

namespace app\admin\model;


use think\Request;

class Article extends Base
{
    protected $visible=['id','title','author','type','status','ctime'];

    public function add()
    {
        $request = Request::instance();
        $data=$request->param();
        $data['status']=1;
        $article = new Article();
        $article->data($data);
        $res=$article->save();
        return $res;
    }

    public function getArticleList(){

        $res = self::with(['img'])->select();
        return $res;
    }

    public function img()
    {
        return $this->belongsTo('Upload','img_id',"id");
    }

    public function getTypeAttr($value)
    {
        $type = [0=>'资讯',1=>'案例',2=>'产品',3=>'通知'];
        return $type[$value];
    }


}