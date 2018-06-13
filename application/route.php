<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//// 注册页面
//\think\Route::get('register', 'admin/Register/register');
//
//// 注册协议
//\think\Route::get('protocol', 'admin/Register/protocol');
//
//// 二维码
//\think\Route::get('weima', 'admin/Index/index');
//
//// rsa 加密解密
\think\Route::get('rsa', 'admin/Index/rsa');
//
//// 路由完全匹配需要添加 $
//\think\Route::get('admin/:year$', 'admin/Admin/show');

// 定义路由
return [
    // 模拟权限管理的后台
    'home'=>'admin/Admin/home',             // 主页面
    'rule/:group_id'=>'admin/Admin/rule',   // 权限页面
    'get_rule'=>'admin/Admin/get_rule',     // 修改权限方法
    'error'=>'admin/Admin/nofind',          // 错误页面
    // 时间控件
    'time'=>'admin/Index/showtime',

    'vue'=>'admin/Index/vue'
];