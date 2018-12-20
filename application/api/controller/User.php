<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/7/11
 * Time: 13:48
 */

namespace app\api\controller;

abstract class User
{
    public function eat()
    {

    }

    public function sleep()
    {

    }

    // abstract 抽象类 可以实现自己的方法 接口则不能
    public function holiday()
    {
        echo '5月1日放假...';
    }
}