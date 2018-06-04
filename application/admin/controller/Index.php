<?php
/**
 * Created by PhpStorm.
 * User: 18347
 * Date: 2018/1/18
 * Time: 15:20
 */

namespace app\admin\controller;

use think\Cache;
use think\cache\driver\Redis;
use think\Controller;
use think\Db;

class Index extends Controller
{

    public function show() {

        return view();
    }


//    public function redis()
//    {

//        $options = [
//            // 缓存类型为File
//            'type' => 'redis',
//            // 缓存有效期为永久有效
//            'expire' => 0,
//            'host' => '127.0.0.1', // redis主机
//            'port' => 6379, // redis端口
//            'password' => '', // 密码
//            'select' => 0, // 操作库
//            'timeout' => 0, // 超时时间(秒)
//            'persistent' => true, // 是否长连接
//            'session_name' => '', // sessionkey前缀
//        ];

//        $redis = new Redis($options);

        // set 设置 key 存在则覆盖
//        $result = $redis->set('new','user');

        // setnx 设置 key 存在则不操作
//        $result = $redis->handler()->setnx('new', 'user');

        // expire key 多少秒：设置多少秒后过期；  ttl key:Time To Live，查看还可以存活多久，-2表示key不存在；-1表示定时任务消失，永久存储。
//        $result = $redis->handler()->expire('new','180');
//        $result = $redis->handler()->ttl('new');

        // 设置 key 的值为 value，并在 timeout 秒后失效，key 将被删除
//        $result = $redis->handler()->setex('new','180','word');

        // 取消过期时间
//        $result = $redis->handler()->persist('new');

        // 向 key 的字符串追加拼接
//        $result = $redis->handler()->append('new',':song');


        // HASH （哈希）
        // hSet 给哈希表中某个 key 设置值.如果值已经存在, 返回 false  成功1 存在则替换返回0 失败0
//        $result = $redis->handler()->delete('Set');
//        $result = $redis->handler()->hSet('Set','key1','hello');
//        $result = $redis->handler()->hSet('Set','key2','word');
//        $result = $redis->handler()->hSet('Set','key3','we');
//        $result = $redis->handler()->hSet('Set','key4','no');
//        $result = $redis->handler()->hSet('Set','key5','problem');

        // hSerNx 当哈希表中不存在某 key 时，给该 key 设置一个值 成功 true 失败 false
//        $result = $redis->handler()->hSetNx('SetNx','key2','5');

        // hGet 获得某哈希 key 的值.如果 hash 表不存在或对应的 key 不存在，返回 false
//        $result = $redis->handler()->hGet('SetNx','key1');

        // hLen 哈表中 key 的数量.如果 hash 表不存在，或者对应的 key 的值不是 hash 类型，返回 false
//        $result = $redis->handler()->hLen('key');

        // hDel 删除一个哈希 key.如果 hash 表不存在或对应的 key 不存在，返回 false  成功返回 TRUE
//        $result = $redis->handler()->hDel('Set','key2');

        // hKeys 获得哈希表中所有的 key
//        $result = $redis->handler()->hKeys('Set');

        // hVals 获得哈希表中所有的值
//        $result = $redis->handler()->hVals('Set');

        // hGetAll 获得一个哈希表中所有的 key 和 value
//        $result = $redis->handler()->hGetAll('Set');

        // hExists 检查哈希 key是否存在  存在返回 true, 不存在返回 false
//        $result = $redis->handler()->hExists('Set','key1');

        // hIncrBy 给哈希表中某 key 增加一个整数值  val值是数字 返回值 增加后的值
//        $result = $redis->handler()->hIncrBy('SetNx','key2','1');

        // hIncrByFloat 给哈希表中某 key 增加一个浮点数值 返回值 增加后的值
//        $result = $redis->handler()->hIncrByFloat('SetNx','key2','-0.5');

        // hMSet 给哈希表设置多个 key 的值   成功 true 失败 false
//        $result = $redis->handler()->hMSet('MSet',array('name'=>'Jake','age'=>'24','work'=>'PHP'));

        // hMGet 获得哈希表中多个 key 的值
//        $result = $redis->handler()->hMGet('MSet',array('name','age','work'));


        //  SET （无序且唯一集合set）
        // sAdd 添加一个 val 到 set 容器中， user 作为 key 值如果这个 val 已经存在于 set 中，那么返回 false
//        $result = $redis->handler()->sAdd('user1','member4');

        // sRem 移除指定的 val 从 set 容器中
//        $result = $redis->handler()->sRem('user','member');

        // sMove 将 user1 的数据移动到 user 中
//        $result = $redis->handler()->sMove('user1','user','member1');

        // sIsMember 判断 member 元素是否是集合key的成员 bool型
//        $result = $redis->handler()->sIsMember('user','member1');

        // sMembers 返回集合key中的所有成员
//        $result = $redis->handler()->sMembers('out');

        // sCard 返回 set 容器的成员数
//        $result = $redis->handler()->sCard('user');

        // sPop 移除并返回集合中的一个随机元素
//        $result = $redis->handler()->sPop('user2');

        // sInter 返回指定 set 集合的 '交集' 结果 如果在参数中有参数错误，那么则返回 false
//        $result = $redis->handler()->sInter('user','user1');

        // sInterStore 执行一个交集操作，并把结果存储到一个新的 set 容器中
//        $result =  $redis->handler()->sInterStore('out','user','user1');

        // sUnion 执行一个 '并集' 操作在N个 set 容器之间，并返回不重复的结果
//        $result = $redis->handler()->sUnion('user','user1','out');

        // sUnionStore 执行一个并集操作就和 sUnion 一样 但是结果储存在第一个参数中
//        $result = $redis->handler()->sUnionStore('top','user','user1');

        // sDiff 执行 '差集' 操作在N个不同的 set 容器之间 并返回结果 这个操作取得结果是第一个 set 相对于其他参与计算的 set 集合的差集
//        $result = $redis->handler()->sDiff('user','user1');

        // sDiffStore 此命令等同于 sDiff 但它将结果保存到 dst 集合 而不是简单地返回结果集。
//        $result = $redis->handler()->sDiffStore('dst','user','user1');


        // LIST (列表)
        // lPush 作用是将 value 添加到链表 key 的（头部） 不存在 key 时  自动创建
//        $result = $redis->handler()->lPush('list','root');

        // rPush 作用是将 value 添加到链表 key 的 (尾部) 不存在 key 时  自动创建
//        $result = $redis->handler()->rPush('list','ajax7');

        // lPushx 作用是将 value 添加到链表 key 的（头部） 仅当 key 存在时
//        $result = $redis->handler()->lPushx('list','lPushX');

        // rPushx 作用是将 value 添加到链表 key 的（尾部） 仅当 key 存在时
//        $result = $redis->handler()->rPushx('list','lPushX');

        // lPop 作用是将链表 key 的头部元素删除 返回删除的 value
//        $result = $redis->handler()->lPop('list');

        // rPop 作用是将链表 key 的尾部元素删除 返回删除的 value
//        $result = $redis->handler()->rPop('list');

        // lSize 作用是返回链表 key 中有多少个元素
//        $result = $redis->handler()->lSize('list');

        // lRange/lGetRange 作用是返回链表 key 中 start 到 end 位置间的元素 end为-1时，返回所有元素
//        $result = $redis->handler()->lRange('list',0,-1);

        // lTrim/listTrim 清空索引在start 和 end 之外的元素，索引从0开始，两端保留，两端之外的清空
//        $result = $redis->handler()->lTrim('list',1,6);

        // lRem/lRemove 删除链表 key 中 count 个值为 value 的元素 count 为 0 则删除所有 value count 大于 0 从头开始 count 小于 0 从尾部开始
//        $result = $redis->handler()->lRem('list1','root',0);

        // lGet/lIndex 返回链表 list 中 index 位置元素  index 代表的是索引值
//        $result = $redis->handler()->lGet('list',0);

        // lSet 将链表 list 的 index 位置的元素值设为 value index 代表的是索引值
//        $result = $redis->handler()->lSet('list',1,'root');

        // lLen 获取链表中 list 的长度
//        $result = $redis->handler()->lLen('list');

        // 源队列 srckey 目标队列 dstkey 将 srckey 的最后一个移除，并放到 dstkey 的第一个。
//        $result = $redis->handler()->rpoplpush('list1','list');

        // sort 排序默认以数字作为对象 排序方式要使用数组
//        $result = $redis->handler()->sort('price',array('sort'=>'desc'));

        // 使用 limit 修饰符限制返回结果
//        $result = $redis->handler()->sort('price',array('sort'=>'desc','limit'=>array(0,3)));

        // 使用 alpha 修饰符对字符串进行排序 方式是使用数组
//        $result = $redis->handler()->sort('list',array('alpha'=>'true','sort'=>'desc'));

        // 使用 limit 修饰符限制返回结果
//        $result = $redis->handler()->sort('list',array('alpha'=>'true','sort'=>'desc','limit'=>array(0,3)));

        // 按 user_level_ 排序 取得 id
//        $result = $redis->handler()->sort('uid',array('by'=>'user_level_*','sort'=>'desc'));

        // 按 uid 排序 取得 多个外部键
//        $result = $redis->handler()->sort('uid',array('by'=>'uid','sort'=>'asc','get'=>array('user_name_*','user_level_*')));

        // 将哈希表作为 get 或 by 的参数
//        $result = $redis->handler()->sort('uid',array('by'=>'user_info_*->level','get'=>'user_info_*->name'));
//        dump($result);

//    }

    // 二维码
    public function index()
    {
        // 生成二维码
        $img = $this->scerweima('https://www.baidu.com');
        $this->assign('img', $img);
        return view();
    }
    // 生成原始的二维码(生成图片文件)
    function scerweima($url=''){

        vendor('qrcode.phpqrcode');
        $value = $url;                  //二维码内容

        $errorCorrectionLevel = 'H';    //容错级别
        $matrixPointSize = 5;           //生成图片大小

        $img = microtime().'.png';

        //生成二维码图片
        $filename = './static/qrcode/'.$img;

        \QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        // 这里返回的是纯二维码图片
//        return 'http://localhost/thinkphp_5.0/public/static/qrcode/'.$img;

        //准备好的logo图片,本人放在了根目录下
        $logo = './static/qrcode/logo.jpg';

        //logo图片存在
        if ($logo !== FALSE) {
            $qrcode = imagecreatefromstring(file_get_contents($filename));
            $logo = imagecreatefromstring(file_get_contents($logo));
            if (imageistruecolor($logo))
            {
                imagetruecolortopalette($logo, false, 65535); //添加这行代码来解决颜色失真问题
            }
            $qrcode_width = imagesx($qrcode);   //二维码图片宽度
            $qrcode_height = imagesy($qrcode);  //二维码图片高度
            $logo_width = imagesx($logo);       //logo图片宽度
            $logo_height = imagesy($logo);      //logo图片高度
            $logo_qr_width = $qrcode_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($qrcode_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($qrcode, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
                $logo_qr_height, $logo_width, $logo_height);
        }

        $new_img = 'logo.png';
        //输出图片
        imagepng($qrcode, './static/qrcode/'.$new_img);  //保存合成图片，命名logqr.png放在该地址中

        // 返回的是带有logo的二维码图片
        return 'http://localhost/thinkphp_5.0/public/static/qrcode/'.$new_img;
    }

    // rsa加密解密
    public function rsa()
    {
        // rsa 加密
        $rsaPublicKeyFilePath = "./public/static/key/public_key.pem";
        $public_content=file_get_contents($rsaPublicKeyFilePath);
        $public_key=openssl_get_publickey($public_content);
        $original_str='{"phone":"18347267288","type":"register"}';
        $original_arr=str_split($original_str,117);  //折分
        $original_enc_arr = array();
        foreach($original_arr as $o) {
            $sub_enc=null;
            openssl_public_encrypt($o,$sub_enc,$public_key);
            $original_enc_arr[]=$sub_enc;
        }
        openssl_free_key($public_key);
        $original_enc_str=base64_encode(implode('',$original_enc_arr));//最终网络传的密文

        dump($original_enc_str);

        // rsa 解密
        $rsaPrivateKeyFilePath = "./public/static/key/private_key.pem";
        $private_content = file_get_contents($rsaPrivateKeyFilePath);
        $private_key = openssl_get_privatekey($private_content);
        $original_enc_str = base64_decode($original_enc_str);
        $orig_dec_str = '';
        for ($i = 0; $i < strlen($original_enc_str) / 128; $i++) {
            $data = substr($original_enc_str, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $private_key);
            $orig_dec_str .= $decrypt;
        }

        dump($orig_dec_str);
    }
}