<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ge
 * Date: 18-4-28
 * Time: 上午11:10
 * To change this template use File | Settings | File Templates.
 */

class Common {
    public  function curl_get($url, $data = array(), $timeout = 3) {
        $curl = curl_init();
        $headers = array(
            "Content-type: application/json;charset='utf-8'",
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
        );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if ($data) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $content = curl_exec($curl);
        curl_close($curl);
        return $content;
    }

    public function htmlencoder($code) {
        return htmlspecialchars($code,ENT_QUOTES);
    }

    public  function outPutJson($arr){
        $arr = $this->_convertOutput($arr);
        echo json_encode($arr);
        exit;
    }

    public function _convertOutput($data){
        if(is_string($data)){

        }
        if(is_int($data)){
            $data = (int)$data;
        }
        if(is_array($data)){
            foreach($data as $k => $v){
                $data[$k] = $this->_convertOutput($v)
                ;
            }
        }
        return $data;
    }
}