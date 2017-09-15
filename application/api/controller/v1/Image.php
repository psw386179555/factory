<?php
/**
 * Created by SvenBarnett.
 * Author 斯文<386179555@qq.com>
 * Date: 2017/8/16
 * Time: 17:10
 */

namespace app\api\controller\v1;

use app\api\model\Image as ImageModel;

use app\lib\exception\UploadException;
use think\Config;


class Image
{
    /**
     * 单图上传
     * @param $file(传入$file对象）
     * @return mixed
     * @throws UploadException
     */
    public function uploadImage()
    {
            $file = request()->file('image');
            if (!$file) {
                $file = request()->file('file');
            }
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $path = getUploadPath('/uploads/' . $info->getSaveName());



                $imageModel = new ImageModel();
                $imgID = $imageModel->saveImage($path);

                $path = Config::get('myconfig.img_prefix').$path;

                $res = [
                    'img_id'=>(int)$imgID,
                    'path'=>$path
                ];

                return $res;
            } else {
                $msg = $file->getError();
                throw new UploadException([
                    'code' => 400,
                    'msg' => $msg,
                    'errorCode' => 40003
                ]);

            }
        }


    public function uploadImageForLayui()
    {
        $file = request()->file('image');
        if (!$file) {
            $file = request()->file('file');
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            $path = getUploadPath('/uploads/' . $info->getSaveName());
            $imageModel = new ImageModel();
            $imgID = $imageModel->saveImage($path);
            $path = Config::get('myconfig.img_prefix').$path;
            $res = [
                'code'=>0,
                'msg'=>'成功！',
                'data'=>[
                    'src'=>$path,
                    'title'=>'图片'.$imgID
                ]
            ];
            return $res;
        } else {
            $msg = $file->getError();
            throw new UploadException([
                'code' => 400,
                'msg' => $msg,
                'errorCode' => 40003
            ]);

        }
    }


}
