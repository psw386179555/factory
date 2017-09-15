<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/1
 * Time: 11:14
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Upload as UploadModel;

class Upload extends Controller
{
    public function uploadImg(){
        $file = request()->file('image');
        if (!$file){
            $file = request()->file('file');
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $path =  getUploadPath('/uploads/'.$info->getSaveName());
            $upload=new UploadModel();
            $res = $upload->saveImg($path);
            return json(['code'=>0,'msg'=>'上传成功','data'=>['src'=>$path,'img_id'=>$res]]);
        }else{
           $msg= $file->getError();
            return json(['code'=>1,'msg'=>$msg,'data'=>'']);
        }
    }

}