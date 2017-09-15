<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/18
 * Time: 13:53
 */

namespace app\api\controller\v1;
use app\api\model\Member as MemberModel;
use app\api\service\Token as TokenService;
use app\lib\exception\MemberException;
use app\lib\exception\ParameterException;
use think\Cache;

class Member extends BaseController
{
    protected $beforeActionList = [
        'checkSuperExclusiveScope' => ['only' => 'saveOrUpdateMember']
    ];
    public function addMember($token=''){
        $mid = TokenService::getCurrentMid();

        $res = (new MemberModel())->addMember($mid);

        return $res;
    }

    public function addVerify()
    {
        $mid = TokenService::getCurrentMid();
        $res = (new MemberModel())->addVerify($mid);
        return $res;
    }

    public function verifyInfo()
    {
        $mid = TokenService::getCurrentMid();
        $res = (new MemberModel())->findMember($mid);
        if (!$res){
            throw new MemberException([
                'msg'=>'member is not exist',
                'errorCode'=>50001
            ]);
        }
        $res->visible(['name','beco','duty','status','phone']);
        return $res;
    }
    /**
     * 第三方app用户展示CMS
     */

    public function getAllMember($page,$rows,$status=''){
        $res = (new MemberModel())->getAllMember($page,$rows,$status);
        return $res;
    }
    /**
     * 第三方app更新用户信息
     */
    public function saveOrUpdateMember()
    {
       $res = (new MemberModel())->updateMember();
       return $res;
    }

}