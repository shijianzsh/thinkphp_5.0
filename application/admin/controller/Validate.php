<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/9/6
 * Time: 16:15
 */

namespace app\admin\controller;

use app\common\model\Validate as valid;
class Validate extends Basic
{
    public function index()
    {
        $rule = [
            ['name','require|max:5','名称必须|名称最多不能超过5个字符'],

        ];

        $data = [
            'name'  => 'thinkphp',
            'age'   => 10,
            'email' => 'thinkphp@qq.com',
        ];

        $validate = new \think\Validate($rule);
        if (!$validate->check($data)) {

            dump($validate->getError());
        }
    }
}