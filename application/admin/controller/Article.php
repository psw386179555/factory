<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/31
 * Time: 15:15
 */

namespace app\admin\controller;
use app\admin\model\Article as ArticleModel;
use think\Request;
class Article extends Auth
{
    public function  _initialize()
    {
        parent::_initialize();
        $this->assign('title','文章管理');
        $this->assign('tab','article');
    }

    public function index()
    {
        $article=new ArticleModel();
        $res=$article->getArticleList();
        $this->assign('article',$res);
        return $this->fetch();
    }

    public function add()
    {
        if (Request::instance()->isPost()){
            $article=new ArticleModel;
            $res=$article->add();
            if ($res){
                return json(['code'=>0,'msg'=>'添加成功！']);
            }else{
                return json(['code'=>1,'msg'=>'添加失败！']);
            }

        }else{
            return $this->fetch();
        }

    }
}