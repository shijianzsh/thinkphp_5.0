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

// 注册页面
//\think\Route::get('register', 'admin/Register/register');

// 注册协议
//\think\Route::get('protocol', 'admin/Register/protocol');

// 二维码
//\think\Route::get('weima', 'admin/Index/index');

// rsa 加密解密
//\think\Route::get('rsa', 'admin/Index/rsa');

// 路由完全匹配需要添加 $
//\think\Route::get('admin/:year$', 'admin/Admin/show');

// 时间对比
\think\Route::rule('time', 'admin/Index/showtime');

// vue 请求的数据
\think\Route::rule('vue/:a', 'admin/Index/vue');

// 正则
\think\Route::rule('zhengz', 'admin/Regular/index');
\think\Route::rule('shiLi', 'admin/Regular/shiLi');

// implode explode in_array each
\think\Route::get('a', 'api/Index/a');

// count reset current next end prev
\think\Route::get('b', 'api/Index/b');

// array_search array_change_key_case array_chunk array_combine array_diff array_diff_key array_diff_assoc
\think\Route::get('c', 'api/Index/c');

// array_intersect
\think\Route::get('d', 'api/Index/d');

// array_fill array_filter array_flip array_keys array_key_exists
\think\Route::get('e', 'api/Index/e');

// array_map array_walk array_walk_recursive
\think\Route::get('f', 'api/Index/f');

// compact extract array_merge array_merge_recursive
\think\Route::get('g', 'api/Index/g');

// range array_count_values array_pad array_product array_num array_push array_rand array_reverse
\think\Route::get('h', 'api/Index/h');

// array_reduce array_slice array_splice
\think\Route::get('i', 'api/Index/i');

// 排序函数
\think\Route::get('j', 'api/Index/j');

\think\Route::get('k', 'api/Index/k');

// 文件操作
\think\Route::get('l', 'api/Index/l');

// try catch 抛异常
\think\Route::get('m', 'api/Index/m');

// 多继承的实现
\think\Route::rule('home', 'api/Home/index');

\think\Route::rule('canvas', 'api/Home/canvas');

\think\Route::rule('yzheng','admin/Validate/index');

\think\Route::rule('login', 'api/User/login');

\think\Route::rule('quick_login', 'api/User/login_code');

\think\Route::rule('send', 'api/User/sendMsg');

\think\Route::rule('register', 'api/User/register');

\think\Route::rule('session', 'admin/Index/session');
\think\Route::rule('check_session', 'admin/Index/check_session');

// 百度AI识别身份证信息
\think\Route::get('card_discern', 'admin/Regular/card_discern');

// 文件上传
\think\Route::rule('upload_index', 'admin/Upload/index');
\think\Route::rule('upload_pic', 'admin/Upload/upload_pic');

// 资源路由测试
\think\Route::resource('user/:user_id', 'admin/User', ['before_behavior'=>'\app\admin\behavior\UserCheck']);

// 定义路由
//return [
//    // 模拟权限管理的后台
//    'admin'=>'admin/Admin/home',             // 主页面
//    'rule/:group_id'=>'admin/Admin/rule',   // 权限页面
//    'get_rule'=>'admin/Admin/get_rule',     // 修改权限方法
//    'error'=>'admin/Admin/nofind',          // 错误页面
//
//    'set_time' => 'admin/Index/set_time', // 多个倒计时
//];

