<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/7/28
 * Time: 16:58
 */

namespace app\common\model;

use think\Model;

class Advert extends Model {

    protected $table = 'l_advert';

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function selectAdvert($where = '', $field = '', $order = '')
    {
        $arr = \model('Advert')->where($where)->field($field)->order($order)->select();

        return object_to_array($arr);
    }
}