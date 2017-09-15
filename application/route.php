<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//轮播图
Route::get('api/:version/banner','api/:version.Banner/getBanner');
Route::post('api/:version/banner/app/status','api/:version.Banner/changeBannerStatus');
Route::post('api/:version/banner/app/all','api/:version.Banner/getAllBanner');
Route::post('api/:version/banner/app/save','api/:version.Banner/saveOrUpdateBanner');


//文章
Route::group('api/:version/article',function (){
    Route::get('','api/:version.Article/getArticleList');
    Route::get('/:id','api/:version.Article/getArticle',[],['id'=>'\d+']);
    Route::post('/app/all','api/:version.Article/getAllArticle');
    Route::post('/app/update','api/:version.Article/saveOrUpdateArticle');
});

//通知
Route::get('api/:version/notice','api/:version.Article/getNoticeList');
Route::get('api/:version/notice/:id','api/:version.Article/getArticle',[],['id'=>'\d+']);

//企业
Route::get('api/:version/company','api/:version.Company/getCoByToken');
Route::get('api/:version/company/show/:id','api/:version.Company/showCoByCoId',[],['id'=>'\d+']);
Route::get('api/:version/company/verified','api/:version.Company/getCoListByStatus');
Route::post('api/:version/company/add','api/:version.Company/addCo');
Route::post('api/:version/company/app/all','api/:version.Company/getAllCompany');
Route::post('api/:version/company/app/update','api/:version.Company/saveOrUpdateCompany');

//申请
Route::post('api/:version/apply/add','api/:version.Apply/addApply');
Route::get('api/:version/apply/member','api/:version.Apply/applyList');
Route::post('api/:version/apply/app/all','api/:version.Apply/getAllApply');
Route::post('api/:version/apply/app/update','api/:version.Apply/saveOrUpdateApply');


//会员
Route::post('api/:version/member/add','api/:version.Member/addMember');
Route::post('api/:version/member/verify','api/:version.Member/addVerify');
Route::post('api/:version/member/verify/info','api/:version.Member/verifyInfo');
Route::post('api/:version/member/app/all','api/:version.Member/getAllMember');
Route::post('api/:version/member/app/update','api/:version.Member/saveOrUpdateMember');

//反馈
Route::post('api/:version/feedback/add','api/:version.Feedback/addFeedback');


//图片上传
Route::post('api/:version/image/upload','api/:version.Image/uploadImage');
Route::post('api/:version/image/layui','api/:version.Image/uploadImageForLayui');


//Token验证
Route::post('api/:version/token/member','api/:version.Token/getToken');
Route::post('api/:version/token/verify','api/:version.Token/verifyToken');
Route::post('api/:version/token/app','api/:version.Token/getAppToken');