<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/10/17
 * Time: 10:23
 */

namespace app\common\model;

use Qcloud\Sms\SmsSingleSender;
use think\Model;

class SendMsg extends Model
{

    // 短信应用SDK AppID
    const appid = 1400098471; // 1400开头

    // 短信应用SDK AppKey
    const appkey = "d695bac0e45f293773d4d51b71e97570";

    // 短信模板ID，需要在短信应用中申请
    const templateId = 132827;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

    // 签名
    const smsSign = "腾讯云"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

    public function send($phone,$code,$time)
    {
        vendor('qcloudsms.src.index');

        $ssender = new SmsSingleSender(self::appid,self::appkey);

        $params = [$code,$time];

        $result = $ssender->sendWithParam("86", $phone, self::templateId, $params, '', "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
//        echo $result;

        $rsp = json_decode($result);

        return $rsp;
    }
}