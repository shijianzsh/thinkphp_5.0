<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/5/17
 * Time: 20:32
 */

namespace app\admin\controller;

use think\Controller;

class Register extends Controller
{
    public function register()
    {
        return view();
    }

    public function protocol()
    {
        return '注册协议详情';
    }
}