<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    protected $config = [];

    public function _initConfig(Yaf_Dispatcher $dispatcher)
    {
        $this->config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $this->config);

    }

    /**
     * 加载数据库
     */
    public function _initDatabase()
    {

    }

    /**
     * 加载插件
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {

    }


    /**
     * 加载公共函数库
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initFunction(Yaf_Dispatcher $dispatcher)
    {
        Yaf_Loader::import('function/Common.php');
    }
}