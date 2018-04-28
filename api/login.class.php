<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ge
 * Date: 18-4-28
 * Time: 上午11:04
 * To change this template use File | Settings | File Templates.
 */
include 'common.class.php';
include 'memcache.class.php';
class Login extends Common {
    public function getOpenid() {
        $code = $this->htmlencoder($_GET['code']);
        $appid = APPID;
        $appsecret = APPSECRET;
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$appsecret&js_code=$code&grant_type=authorization_code";
        $result = $this->curl_get($url);
        $arr = json_decode($result,true);
        if(!$arr['errcode']) {
            $key = $this->trd_session(64);
            $mem = new Memcache();
            $mem->memcacheSet($result,$key,600);
            $this->outPutJson(array(
                'result' => 200,
                'sessionid' => ,
            ));
        } else {

        }

        return false;
    }

    public function trd_session($len) {
        $fp = @fopen('/dev/urandom','rb');
        $result = '';
        if ($fp !== FALSE) {
            $result .= @fread($fp, $len);
            @fclose($fp);
        } else {
            trigger_error('Can not open /dev/urandom.');
            $result = time() . rand(1,100000000);
        }
        $result = base64_encode($result);
        $result = strtr($result, '+/', '-_');
        return substr($result, 0, $len);
    }
}
