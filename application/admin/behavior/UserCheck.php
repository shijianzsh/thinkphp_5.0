<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2019/8/14
 * Time: 19:31
 */

namespace app\admin\behavior;

class UserCheck
{
    public function run()
    {
        if('/thinkphp5/user/0' == request()->url()){
            exit('请先登录');
        }
    }
}