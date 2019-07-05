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
        // $ret = \app\common\model\Admin::createAdmin();
        // dump($ret);
        return view();
    }

    /**
     * Desc: 单个文件上传
     * Created by LiuHW
     * Date: 2018/10/23
     */
    public function upload_pic()
    {
        $image = input('formData');
        dump($image);
        dump(base64_image_content($image));
    }
}