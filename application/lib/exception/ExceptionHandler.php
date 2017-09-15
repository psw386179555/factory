<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/7/30
 * Time: 12:41
 */

namespace app\lib\exception;

use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;


    public function render(\Exception$e)
    {
        if ($e instanceof BaseException){
            //自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;

        }else{

            if (config('app_debug')){

                return parent::render($e);

            }else{

                $this->code = 500;
                $this->msg = 'service error！';
                $this->errorCode = 900;
                $this->recordErrorLog($e);
            }

        }

        $request = Request::instance();

        $result = [
            'msg'=>$this->msg,
            'error_code'=>$this->errorCode,
            'request_url'=>$request->url()
        ];

        return json($result,$this->code);

    }

    private function recordErrorLog(\Exception $e)
    {
        Log::init([
           'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}