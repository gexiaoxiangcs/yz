<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ge
 * Date: 18-4-28
 * Time: 上午11:04
 * To change this template use File | Settings | File Templates.
 */
include 'common.class.php';
class Login extends Common {
    public function getOpenid() {
        $code = $this->htmlencoder($_GET['code']);
        $appid = APPID;
        $appsecret = APPSECRET;
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$appsecret&js_code=$code&grant_type=authorization_code";
        $this->outPutJson(array(
            'result' => 200,
            'data' => $this->curl_get($url),
        ));
    }
}
