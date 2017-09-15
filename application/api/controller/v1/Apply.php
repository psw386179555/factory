<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/18
 * Time: 9:44
 */

namespace app\api\controller\v1;
use app\api\model\Apply as ApplyModel;
use app\api\service\Token as TokenService;
use app\api\validate\ApplyAdd;
use app\lib\exception\ApplyException;

use app\api\service\Apply as ApplyService;


class Apply extends BaseController
{
    protected $beforeActionList=[
        'checkSuperExclusiveScope'=>['only'=>'applyList,saveOrUpdateApply']
    ];

    public function addApply()
    {
        (new ApplyAdd())->goCheck();

        $mid = (new TokenService())->getCurrentMid();

        $res = ApplyService::saveApply($mid);

        return $res;
    }

    public function applyList()
    {
        $mid = TokenService::getCurrentMid();

        $res = (new ApplyModel())->applyList($mid);
        if ($res->isEmpty()){
            throw new ApplyException([
                'msg' => 'apply missing',
                'errorCode' =>'40005'
            ]);
        }

        $res->visible(['id','project_name','status','create_time']);

        return $res;
    }
    /**
     * 第三方app获取所有申请
     */
    public function getAllApply($page,$rows,$status='')
    {
        $res = ApplyModel::getAllApply($page,$rows,$status);
        return $res;
    }

    /**
     * 第三方app更新申请状态
     *
     */
    public function saveOrUpdateApply()
    {
        $res = ApplyModel::saveOrUpdateApply();

        return $res;
    }
}