<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/4
 * Time: 11:40
 */

namespace app\api\controller\v1;

use app\api\model\Article as ArticleModel;

use app\api\validate\IDMustBePositiveInt;

use app\lib\exception\ArticleMissException;

class Article
{
    /**
     * @param $id
     * @return 返回具体id的文章
     * @throws ArticleMissException
     */
    public function getArticle($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $article =ArticleModel::getArticleByID($id);

        if (!$article)
        {
            throw new ArticleMissException;
        }
        $article->hidden(['img_id','id','type']);

        return $article;
    }

    /**
     * @return 返回非通知类型文章列表
     * @throws ArticleMissException
     */
    public function getArticleList()
    {
        $article =ArticleModel::getArticleList();

        if ($article->isEmpty())
        {
            throw new ArticleMissException;
        }

       $article->hidden(['content','sum','keyword','author']);

        return $article;
    }

    /**
     * @return 返回通知类型的文章列表
     * @throws ArticleMissException
     */
    public function getNoticeList()
    {

        $notice = ArticleModel::getNoticeList();

        if ($notice->isEmpty())
        {
            throw new ArticleMissException;
        }
        $notice->hidden(['content','sum','keyword','type']);

        return $notice;
    }
    /**
     * 第三方app获取文章通知列表
     */

    public function getAllArticle($page,$rows,$status='',$sort,$order)
    {
        $res = ArticleModel::getAllArticle($page,$rows,$status,$sort,$order);
        return $res;
    }

    public function saveOrUpdateArticle()
    {
        $res = ArticleModel::saveOrUpdateArticle();

        return $res;
    }

}