<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/7/28
 * Time: 14:47
 */

namespace app\api\controller;

class Home extends User
{
//    use A,B;  // 多继承 使用的是 trait

    /*// 接口的多继承实现   class Home implements A,B
    // 继承的方法必须实现
    public function eat()
    {
        echo '吃货';
    }

    public function sleep()
    {

    }*/

    public function index()
    {
        echo phpinfo();
    }

    public function canvas()
    {
        header('Content-type: image/png');
        $image = imagecreate(310,150);
        $black = imagecolorallocate($image,0,0,0);
        $white = imagecolorallocate($image,255,255,255);
        $font = 'public/static/fonts/glyphicons-halflings-regular.ttf';//中文需要一个字体文件，这里用的是微软雅黑(粗)，需要上传到网站的相应目录
        imagettftext($image,10,0,0,25,$white,$font,'Hello world');
        imagettftext($image,10,0,0,55,$white,$font,'你好');

        imagepng($image);
        imagedestroy($image);
    }
}