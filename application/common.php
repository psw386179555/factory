<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function getUploadPath($str)
{
    if(strpos($str,'\\') !== false){
        return str_replace('\\','/',$str);
    }else{
        return $str;
    }
}

/**
 * http get
 *
 */
function curl_get($url,$httpCode=0)
{
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //不做证书校验
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $data;
}

/**
 * 获取随机字符串
 */

function getRandChars($len)
{
    $str = null;
    $strPoll="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max =strlen($strPoll)-1;
    for ($i=0;$i<$len;$i++){
        $str.=$strPoll[rand(0,$max)];

    }
    return $str;
}

function getMidByToken($token)
{
    $cache =json_decode(cache($token),true);
    $mid = $cache['mid'];
}