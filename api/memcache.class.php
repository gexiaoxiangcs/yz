<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ge
 * Date: 18-3-22
 * Time: 下午4:21
 * To change this template use File | Settings | File Templates.
 */

class Mem{
    public  function memcacheSet($data, $key, $time){
        $this->memcacheInit();
        $key = $this->_k($key);
        return $this->memcon->set($key, $data, 0, $time);
    }

    public function memcacheGet($key){
        $this->memcacheInit();
        $key = $this->_k($key);
        $result = $this->memcon->get($key);
        return $result;
    }

    public function memcacheDel($key){
        $this->memcacheInit();
        $key = $this->_k($key);
        return $this->memcon->delete($key);
    }

    public function memcacheIncr($key, $interval = 1){
        $this->memcacheInit();
        $key = $this->_k($key);
        $result = $this->memcon->increment($key, $interval);
        return $result;
    }

    public function memcacheDecr($key, $interval = 1){
        $this->_memcacheInit();
        $key = $this->_k($key);
        $result = $this->memcon->decrement($key, $interval);
        return $result;
    }

    private function memcacheInit(){
        if(!$this->memcon){
            $this->memcon = new Memcache();
            $this->memcon->connect(MEM_HOST, MEM_PORT);
        }
    }

    private function _k($k){
        return md5($this->memprev . $k);
    }
}