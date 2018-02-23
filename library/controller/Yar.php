<?php
/**
 * 需要安装 yar扩展，实现yar的RPC服务
 */

abstract  class Yar extends Yaf_Controller_Abstract{

    public function init(){
        //控制器初始化
        if (method_exists($this, '_initialize')) {
            $this->_initialize();
        }

        //判断扩展是否存在
        if (!extension_loaded('yar')) {
            throw new \Exception('not support yar');
        }

        //实例化Yar_Server
        $server = new \Yar_Server($this);
        // 启动server
        $server->handle();
    }

    /**
     * 魔术方法 有不存在的操作的时候执行
     * @access public
     * @param string $method 方法名
     * @param array $args 参数
     * @return mixed
     */
    public function __call($method, $args)
    {}
}