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
 */
public function base64_image_content()
    {
        $base64_image_content = I('pic');   // 接收图片的base64
        $base64_image = str_replace(' ', '+', $base64_image_content);
        // 阿里云上传文件的名称方式 文件名同本地的临时储存目录
        $ryear=date("Y",time());
        $rmm=date("m",time());
        $rdd=date("d",time());
        $path = '../static/'. $ryear . '/' . $rmm  . '/' . $rdd . '/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        //post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
            // 文件储存名称
            $image_name = time() . rand(111111, 999999).'.'.$result[2];
            // 文件储存地址 （包含文件和后缀）
            $image_file = $path . $image_name;
            //服务器文件存储路径
            if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
                // oss
                vendor('oss.autoload');
                $oss_path = 'ad/' . $ryear . '/' . $rmm  . '/' . $rdd . '/' . $image_name;
                try{
                    $ossClient = new OssClient($this->access_id, $this->access_key, $this->endpoint);

                    $ret = $ossClient->uploadFile($this->bucket, $oss_path, $image_file);
                    if (!$ret) {
                        throw new OssException('上传失败！');
                    }
                    var_dump($oss_path);
                    @unlink($path . $image_name);  // 删除本地存储
                } catch (OssException $e) {
                    var_dump($e->getMessage());
                    return;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
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
