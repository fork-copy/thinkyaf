<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    protected $config = [];

    /**
     * 加载公共函数库
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initFunction(Yaf_Dispatcher $dispatcher)
    {
        Yaf_Loader::import('function/Common.php');
    }

    public function _initConfig(Yaf_Dispatcher $dispatcher)
    {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config);

    }

    /**
     * 加载数据库
     */

    public function _initDatabase(Yaf_Dispatcher $dispatcher)
    {
        \think\Db::setConfig();
    }
}