<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/12/24
 * Time: 22:39
 */

namespace app\common\model;

use think\Model;

class Admin extends Model
{
    static public function createAdmin()
    {
        $Obj = new Admin();
        $data['name'] = '张';
        $data['is_admin'] = 0;
        $data['status'] = 0;
        return $Obj->save($data);
    }
}