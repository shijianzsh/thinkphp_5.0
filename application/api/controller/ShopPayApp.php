<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2019/6/18
 * Time: 19:49
 */
namespace app\api\controller;

use think\Controller;
use think\Log;

class ShopPayApp extends Controller
{
    private $config = [
        'appid' => 'wxf02fa301fc4ef8ef',
        'mch_id' => '1483614952',
        'api_key' => '',
        'notify_url' => ''
    ];

    public function get_pre_pay_order()
    {
        $body = 'APP支付测试';
        $out_trade_no = '20190618520';
        $total_fee = 100;
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $notify_url = $this->config['notify_url'];

        $nonce_str = $this->create_nonce_str();

        $data['appid'] = $this->config['appid'];
        $data['body'] = $body;
        $data["mch_id"] = $this->config['mch_id'];
        $data["nonce_str"] = $nonce_str;
        $data["notify_url"] = $notify_url;
        $data["out_trade_no"] = $out_trade_no;
        $data["spbill_create_ip"] = $this->get_client_ip();
        $data["total_fee"] = $total_fee;
        $data["trade_type"] = "APP";
        $sign = $this->get_sign($data);
        $data["sign"] = $sign;

        $xml = $this->array_to_xml($data);
        $response = $this->post_xml_curl($xml, $url);

        //将微信返回的结果xml转成数组
        $response = $this->xml_to_array($response);
        //返回数据
        if ($response['return_code'] != 'SUCCESS') {
            return '签名失败';
        } else {
            //接收微信返回的数据,传给APP!
            $data["appid"] = $this->config["appid"];
            $data["noncestr"] = $nonce_str;
            $data["package"] = "Sign=WXPay";
            $data["partnerid"] = $this->config['mch_id'];
            $data["prepayid"] = $response['prepay_id'];
            $data["timestamp"] = time();
            $s = $this->get_sign($data);
            $data["sign"] = $s;

            return $data;
        }
    }

    /**
     * 作用：生成签名
     * @param $Obj
     * @return string
     */
    public function get_sign($Obj)
    {
        foreach ($Obj as $k => $v){
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->format_biz_query_para_map($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String."&key=".$this->config['api_key'];
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     * 作用：产生随机字符串，不长于32位
     * @param int $length
     * @return string
     */
    public function create_nonce_str($length = 32 )
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * 作用：将array转为xml
     * @param $arr
     * @return string
     */
    public function array_to_xml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    /**
     * 作用：将xml转为array
     * @param $xml
     * @return mixed
     */
    public function xml_to_array($xml)
    {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    /**
     * 以post方式提交xml到对应的接口url
     * @param $xml
     * @param $url
     * @param int $second
     * @return bool|mixed
     */
    public function post_xml_curl($xml,$url,$second=30){
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果

        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            curl_close($ch);
            return false;
        }
    }

    /**
     * 作用：获取当前服务器的IP
     * @return array|false|string
     */
    public function get_client_ip()
    {
        if ($_SERVER['REMOTE_ADDR']) {
            $cip = $_SERVER['REMOTE_ADDR'];
        } elseif (getenv("REMOTE_ADDR")) {
            $cip = getenv("REMOTE_ADDR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $cip = getenv("HTTP_CLIENT_IP");
        } else {
            $cip = "unknown";
        }
        return $cip;
    }

    /**
     * 作用：格式化参数，签名过程需要使用
     * @param $paraMap
     * @param $urlencode
     * @return bool|string
     */
    public function format_biz_query_para_map($paraMap, $urlencode){
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v){
            if($urlencode){
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = "";
        if (strlen($buff) > 0){
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }

    /**
     * 微信回调地址
     */
    public function notify()
    {
        //接收微信返回的数据数据,返回的xml格式
        $xmlData = file_get_contents('php://input');
        //将xml格式转换为数组
        $data = $this->xml_to_array($xmlData);
        //为了防止假数据，验证签名是否和返回的一样。
        //记录一下，返回回来的签名，生成签名的时候，必须剔除sign字段。
        $sign = $data['sign'];
        unset($data['sign']);
        if($sign == $this->get_sign($data)){
            //签名验证成功后，判断返回微信返回的
            if ($data['result_code'] == 'SUCCESS') {
                //根据返回的订单号做业务逻辑
                $data['out_trade_no'];// 商品订单号
                $data['transaction_id'];   // 微信业务流水号
                //处理完成之后，告诉微信成功结果！
                echo '<xml>
                  <return_code><![CDATA[SUCCESS]]></return_code>
                  <return_msg><![CDATA[OK]]></return_msg>
                  </xml>';exit();
            }
            //支付失败，输出错误信息
            else{
                $file = fopen('./log.txt', 'a+');
                fwrite($file,"错误信息：".$data['return_msg'].date("Y-m-d H:i:s"),time()."\r\n");
            }
        }
        else{
            $file = fopen('./log.txt', 'a+');
            fwrite($file,"错误信息：签名验证失败".date("Y-m-d H:i:s"),time()."\r\n");
        }

    }
}