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

function object_to_array($object){
    $result = null;
    if($object){
        $result = json_decode(json_encode($object),true);
    }
    return $result;
}

/**
 * base64上传图片
 * @param $base64_image_content
 * @param $path
 * @return bool|string
 */
function base64_image_content($base64_image_content){
    $base64_image = str_replace(' ', '+', $base64_image_content);
    $path='./Images/'.date('Ymd',time());
    $way='upload';
    if (!is_dir($path)) mkdir($path);
    //post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
        //匹配成功
        if($result[2] == 'jpeg'){
            $image_name = create_guid('admin').'.jpg';
        }else{
            $image_name = create_guid('admin').'.'.$result[2];
        }
        $image_file = $path."/{$image_name}";
        $info[0]["savepath"]=$path;
        $info[0]["savename"]="/{$image_name}";
        //服务器文件存储路径
        if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
            aliyuns($info,$way);
            return '/upload'.'/'.date('Ymd').'/'.$info[0]["savename"];
        }else{
            return false;
        }
    }else{
        return false;
    }
}

/**
 * 上传阿里云Oss
 * @param $info array 图片信息
 * @param $way string 图片保存地址
 * @param bool $isunlink
 * @param string $bucket
 * @return string
 */
function aliyuns($info, $way, $isunlink=false, $bucket="bangyuanfiles"){
    Vendor('aliyunc.autoload');
    import('aliyunc.autoload', EXTEND_PATH);
    $accessKeyId = "LTAIP0lTYlwtkHwc";//去阿里云后台获取秘钥
    $accessKeySecret = "syTGPkbLL8KeUevUdc0AvxDGA3R3ZC";//去阿里云后台获取秘钥
    $endpoint = "oss-cn-beijing.aliyuncs.com";//你的阿里云OSS地址
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
    // 判断bucketname是否存在，不存在就去创建
    if(!$ossClient->doesBucketExist($bucket)){
        $ossClient->createBucket($bucket);
    }
    $way = empty($way) ? $bucket : $way;
    $path=$info[0]["savepath"] . $info[0]["savename"];
    $object = $way.'/'.date('Ymd').'/'.$info[0]["savename"];//想要保存文件的名称
    try{
        $ossClient->uploadFile($bucket,$object,$path);
    }catch (OssException $e){
        $e->getErrorMessage();
    }
    $oss="";
    return $oss.$object;
}

/**
 * 生成UUID
 * @return [type] [description]
 */
function create_guid($prefix  = '') {
    $chars = md5(uniqid(mt_rand(), true));
    $uuid  = substr($chars,0,8) . '-';
    $uuid .= substr($chars,8,4) . '-';
    $uuid .= substr($chars,12,4) . '-';
    $uuid .= substr($chars,16,4) . '-';
    $uuid .= substr($chars,20,12);
    return $prefix . $uuid;
}