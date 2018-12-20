<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/7/28
 * Time: 14:51
 */

namespace app\common\model;

use think\Model;

class Home extends Model {

    protected $table = 'l_merchant_cate';

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function selectMerchantCate($where = '', $field = '', $order = '')
    {
        $arr = \model('Home')->where($where)->field($field)->order($order)->select();

        return object_to_array($arr);
    }
}