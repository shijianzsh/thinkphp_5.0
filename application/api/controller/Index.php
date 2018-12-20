<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/6/27
 * Time: 16:34
 */

namespace app\api\controller;

use think\Db;
use think\Exception;

class Index {

    public function __construct()
    {
        $this->name = 'Hello';
    }

    /*
    implode(separator,array) 把数组组合成字符串 separator 规定在数组之间放置的内容
    explode(separator,string,limit) 把字符串分割成数组 separator 字符串之间的连接方法 limit 返回数组元素的个数 为空表示所有
    in_array(search,array,type) 如果 type 为 true，则检查搜索的数据与数组的 key 的类型是否相同
    each() 在 PHP7.2 被弃用
    */
    public function a()
    {
        $arr = ['php','div','css'];
        $str = implode(',',$arr);
        dump($str);
        $arr2 = explode(',',$str);
        dump($arr2);
        $arr3 = ['1,2,3,4'];
        dump(in_array(1,$arr3));
    }

    /*
    count(array,mode) 函数计算数组中的单元数目或对象中的属性个数 mode =>0 正常计数 =>1 递归计数
    reset(array) current(array) 指出数组中的第一个元素
    end(array) 指出数组中的最后一个元素
    prev(array) 指出数组中 end() 元素的前一个元素 和 end() 配合使用
    next(array) 指出数组中的第二个元素
    */
    public function b()
    {
        $arr = [
           'volvo'=>[
               'xc60',
               'xc20'
           ],
            'bmw'=>[
                'x3',
                'x5'
            ],
            'yiqi'=>'bara'
        ];
        dump(count($arr));
        dump(count($arr,1));
        $people = array("Steve", "Mark", "David", "Bill");
        dump(current($people));
        dump(next($people));
        dump(reset($people));
        dump(end($people));
        dump(prev($people));
    }

    /*
    array_search(value,array,strict) 在数组中搜索某个 value ,并返回对应的 key , strict(可选) true/false 搜索数据类型和值都一致，和in_array 一样
    array_change_key_case(array,case) case(可选) =>CASE_LOWER 默认值，转换为小写 =>CASE_UPPER 转换为大写
    array_chunk(array,size,preserve_key) 把函数分割成新的数组 size 规定数组包含的元素个数， preserve_key(可选) true/false 是否保留原始键名
    array_combine(keys,values) 合并两个数组来创建一个新数组，其中的一个数组是 key ,另一个是 value ,两个数组元素必须相同
    array_diff(array1,array2,array3...) 比较多个数组的value ,只返回第一个数组在其他数组中没有的, key 保持不变，返回的是差集
    array_diff_key(array1,array2,array3...) 比较数组的 key ,用法同 array_diff
    array_diff_assoc(array1,array2,array3...) 比数组的较 key 和 value ，用法同上两个
    */
    public function c()
    {
        $arr = ['a'=>'red','b'=>'bule','c'=>'green'];
        dump(array_search('red', $arr));
        $arr2 = ['Bill'=>'foo'];
        dump(array_change_key_case($arr2,CASE_UPPER));
        $arr3 = ['Bill'=>'60','Steve'=>'56','Mark'=>'31','David'=>'35'];
        dump(array_chunk($arr3,2,true));
        $fname=array("Bill","Steve","Mark");
        $age=array("60","56","31");
        $c=array_combine($fname,$age);
        dump($c);
        $a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
        $a2=array("e"=>"red","f"=>"green","g"=>"blue");
        $result=array_diff($a1,$a2);
        dump($result);
    }

    /*
    array_intersect(array1,array2,array3...)  比较多个数组的 value ，只返回第一个数组在其他数组中有的，key 保持不变，返回的是交集
    其中 array_intersect_key() 和 array_intersect_assoc() 的用法和 array_diff 中的 key 和 assoc 一样，只是取的是交集
    在 key 或是 assoc 的前面加 u 的，是需要用回调函数的
    */
    public function d()
    {
        $a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
        $a2=array("e"=>"red","f"=>"green","g"=>"blue");
        $result=array_intersect($a1,$a2);
        dump($result);
    }

    /*
    array_fill(index,number,value) index 是生成这个数组的第一个索引值，number 是数组元素的个数，value 是提供给数组的值
    array_filter(array,callbackfunction) callbackfunction 过滤数组元素的自定义回调函数
    array_flip(array) 反转数组的 key 和 value
    array_keys(array,value,strict) value 可选，指定的 value ，只返回该 value 对应的 key， strict(可选) true/false 严格对比数据类型
    array_key_exists(key,value) 查询指定的 key，和 array_search、in_array 大致相同
    */
    public function e()
    {
        $arr = array_fill(2,2,'dog');
        dump($arr);
        $arr2 = [2,3,5,6,7,8];
        dump(array_filter($arr2,function ($arr2){
            return $arr2 % 2 == 0;
        }));
        $arr3 = ['a'=>'red'];
        dump(array_flip($arr3));
        $arr4 = [10,20,30,"10"];
        dump(array_keys($arr4,"10",false));
    }

    /*
    array_map(myfunction,array1,array2,array3...) 将自定义的函数作用到数组的每个元素，返回新数组
    array_walk(array,myfunction,userdata...) 对数组中的每个元素使用自定义函数， myfunction 函数的两个参数，第一个是 value ，第二个是 key ,value 前加 & 符号可以改变数组中 value 的值
    array_walk_recursive(array,myfunction,userdata...) 操作更深的数组 用法类似 array_walk()
    */
    public function f()
    {
        $arr = [1,2,3,4,5];
        dump(array_map(function ($arr) {
            return $arr*$arr;
        },$arr));
        $arr2 = ['a'=>'red','b'=>'green','c'=>'blue'];
        array_walk($arr2, function ($value,$key){
            echo 'The key '.$key.' has the value '.$value.'<br/>';
        });
        array_walk($arr2, function (&$value,$key){
            $value = 'yellow';
        });
        dump($arr2);
        $arr3 = ['d'=>'black','e'=>'car'];
        $arr4 = [$arr3,'1'=>'blue','2'=>'yellow'];
        array_walk_recursive($arr4,function ($value,$key){
            echo "键" .$key. "的值是" .$value. "<br>";
        });
    }

    /*
    compact(val1,val2..) 返回一个关联数组， key 是函数的参数， value 是参数的值，如果参数是一个数组，则取数组中的变量值，如果数组中不存在某个参数，则这个参数对应的值也不会获取
    extract(array) 用法和 compact() 正好相反
    array_merge(array1,array2,array3...) 合并多个数组，如果数组元素中有相同的 key ，则会覆盖，如果 key 是整数，则 key 从 0 开始排序
    array_merge_recursive(array1,array2,array3...) 用法和 array_merge() 相同，如果 key 重复，则合并为一个数组
    */
    public function g()
    {
        $firstname = "Bill";
        $lastname = "Gates";
        $age = "60";
        dump(compact("firstname", "lastname", "age"));
        $name = ["firstname", "lastname"];
        dump(compact($name, 'location', 'age'));
        $a = ''; $b = ''; $c = '';
        $arr = ["a" => "Cat","b" => "Dog", "c" => "Horse"];
        extract($arr);
        echo $a .','. $b .','. $c;
        $arr2 = ["red","green"];
        $arr3 = ["blue","yellow"];
        dump(array_merge($arr2,$arr3));
    }

    /*
    range(low,high,step) 创建一个包含指定范围的数组， step(可选)，元素之间的步进制
    array_count_values(array) 对数组中的值进行统计，返回数组，元素为 key ，出现的次数为 value 值
    array_pad(array,size,value) 向数组插入指定的元素，如果 size 的数量比 array 中长度小，则该数组不改动， size 大于 0 插入数组末尾，小于 0 插入数组开头
    array_product(array) 计算数组中的乘积
    array_sum(array) 计算数组中的和
    array_push(array,value1,value2...) 向数组尾部添加一个或多个元素，然后返回新数组的长度
    array_rand(array,number) 返回数组中的随机键名，number 选出的个数，关联数组返回 key
    array_reverse(array,preserve) preserve(可选) true/false 反转数组元素，和 array_flip() 有区别
    */
    public function h()
    {
        $number = range(0,50,10);
        dump($number);
        $arr = ['A','Cat','A','Dog'];
        dump(array_count_values($arr));
        $arr2 = ['red','green'];
        dump(array_pad($arr2,-3,'blue'));
        $arr3 = [5,5,2,10];
        dump(array_product($arr3));
        dump(array_sum($arr3));
        $arr4 = ["red","green"];
        array_push($arr4,"blue","yellow");
        dump($arr4);
        $arr5 = ["red","green","blue","yellow","brown"];
        $random_keys = array_rand($arr5,3);
        echo $arr5[$random_keys[0]]."<br>";
        echo $arr5[$random_keys[1]]."<br>";
        echo $arr5[$random_keys[2]];
        $arr6 = ['Volvo','XC90',['BMW','TOYOTA']];
        dump(array_reverse($arr6,true));
    }

    /*
    array_reduce(array,myfunction,initial) 用回调函数迭代地将数组简化为单一的值 initial 是整数，并且会当成数组中的第一个值放在开始
    array_slice(array,start,length,preserve) start 从数组中取出元素的开始位置， length(可选)返回数组的长度，不设置则返回 start-数组末尾，如果是负数，则从数组末端取出，preserve(可选) true/false 是否保留原来的 key
    array_splice(array,start,length,array) 用法和 array_slice() 相似，从数组中选定元素并用新数组代替，如果 length(可选)为 0 则在数组中start的位置插入新数组，如果 length >0 正序， <0 倒序，返回的是删除掉的数组
    */
    public function i()
    {
        $arr = ['Dog','Cat','Horse'];
        $a = array_reduce($arr,function ($v1,$v2){
           return $v1.'-'.$v2;
        },5);
        dump($a);
        $arr2 = ["red","green","blue","yellow","brown"];
        dump(array_slice($arr2,-2, 2, true));
        $arr3 = array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
        $arr4 = array("a"=>"purple","b"=>"orange");
        array_splice($arr3,1,-1,$arr4);
        dump($arr3);
    }

    /*
    sort(array,sortingtype) 对数组单元从低到高进行排序 sortingtype 默认常规排序，共有六个可选参数，标准的排序，列如：2 > 10 并且会删除原有的 key
    rsort(array,sortingtype) 函数行为与 sort() 相反

    natsort(array) 自然排序，1-9 a-z
    natcasesort(array) 不区分大小写的自然排序

    asort(array,sortingtype) 对数组单元从低到高进行排序并保持索引关系
    arsort(array,sortingtype) 函数行为与 asort() 相反

    ksort(array,sortingtype) 函数用于对数组单元按照键名从低到高进行排序，保留原来的键名，因此常用于关联数组
    krsort(array,sortingtype) 函数行为与 ksort() 相反

    usort(array,myfunction) 利用回调函数排序
    uasort(array,myfunction) 使用回调函数对数组的 value 排序，并保持索引关联（不为元素分配新的键）
    uksort(array,myfunction) 和 uasort 类似，它是对数组的 key 排序
    shuffle(array) 对数组元素随机排序，已有的 key 会被删除
    array_multisort(array1,sorting order,sorting type,array2,array3...) 对多个数组排序，字符串 key 保留，数字 key 被重置
    */
    public function j()
    {
        $cars = ["temp15.txt","temp10.txt", "temp1.txt","temp22.txt","temp2.txt"];
        sort($cars);
        dump($cars);
        natsort($cars);
        dump($cars);
        $arr = ["a"=>4,"b"=>2,"c"=>8,"d"=>"6"];
        uasort($arr,function($a,$b){
            if ($a==$b) return 0;
            return ($a<$b)?-1:1;
        });
        dump($arr);
        uksort($arr,function($a,$b){
            if ($a==$b) return 0;
            return ($a<$b)?-1:1;
        });
        dump($arr);
        $arr2 = ["a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow","e"=>"purple"];
        shuffle($arr2);
        dump($arr2);
    }

    public function k()
    {
        // 包含当前文件所在位置
        echo '当前文件位于' . __FILE__;
        echo '<br>';
        // 当前文件所在的目录
        echo '当前文件位于' . __DIR__;
        echo '<br>';
    }

    /*
    fopen() 打开文件  feof() 检测是否到达文件末尾
    fgets() 逐行读取  fgetcsv() 读取csv文件，把文本转为数组储存在 $arr 中
    fgetc() 逐字读取
    fclose() 关闭文件
    */
    public function l()
    {
        $file = fopen('.htaccess','r');
        // 读取每一行
        while(!feof($file))
        {
            echo fgets($file). "<br>";
        }
        if (feof($file)) echo '文件结尾';
        fclose($file);
    }

    /*
    抛异常信息
    */
    public function m()
    {
        $email = "someone@example.com";
        try {
            if (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
                throw new Exception('邮箱不合法');
            }
            if (strpos($email,'example') !== false) {
                throw new Exception('这是 example 邮箱');
            }
        }
        catch (Exception $e) {
            echo 'Message:'.$e->getMessage();
        }
    }

}