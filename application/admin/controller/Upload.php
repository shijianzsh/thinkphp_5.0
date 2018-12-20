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

    public function index () {
        return view();
    }

    public function upload_pic () {

        if ($_FILES['file']) {
            // 执行代码上传图片
            return $_FILES['file'];
        }
    }
}