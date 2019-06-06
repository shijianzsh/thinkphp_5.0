<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/6/29
 * Time: 13:18
 */

namespace app\admin\controller;

use think\Controller;

class Upload extends Controller
{

    public function index ()
    {
        $ret = \app\common\model\Admin::createAdmin();
        dump($ret);
    }

    /**
     * Desc: 单个文件上传
     * Created by LiuHW
     * Date: 2018/10/23
     * @param string $img       图片
     * @param string $file_url  存放路径
     * @return string
     */
    public function upload_pic()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $files = $this->request->file('file');
        if ($files) {
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $files->move( '../public/uploads/coppa');
            if($info){
                // 成功上传后 获取上传信息
                return str_replace('\\', '/', $info->getSaveName());
            }else{
                // 上传失败获取错误信息
                return $files->getError();
            }
        }
    }
}