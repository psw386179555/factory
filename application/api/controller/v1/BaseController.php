<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/9/1
 * Time: 16:58
 */

namespace app\api\controller\v1;
use app\api\service\Token as TokenService;

use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;

class BaseController extends Controller
{

    protected function checkPrimaryScope()
    {
      TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }

    protected function checkSuperExclusiveScope()
    {
        TokenService::needSuperExclusiveScope();
    }
}