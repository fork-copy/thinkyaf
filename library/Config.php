<?php

/**
 * Config 对应用配置的封装，方便读取
 * Config::get('config')
 *
 * @author NewFuture
 */
class Config
{
    private static $config = [];

    /**
     * 获取配置参数 为空则获取所有配置
     * @access public
     * @param  string $name 配置参数名（支持二级配置 . 号分割）
     * @param  string $range 作用域
     * @return mixed
     */
    public static function get($key = null, $default = null)
    {

        if (!($config = &Config::$config)) {
            $config = Yaf_Registry::get('config')->toArray();
        }
        //如果为空，返回所有的配置
        if ($key == null) {
            return $config;
        }
        // 非二级配置时直接返回
        if (!strpos($key, '.')) {
            $name = strtolower($key);
            $value = isset($config[$name]) ? $config[$name]: null ;
            return null === $value ? $default : $value;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $key, 2);
        $name[0] = strtolower($name[0]);
        return isset($config[$name[0]][$name[1]]) ? $config[$name[0]][$name[1]] : $default;
    }

    public static function set($key, $data)
    {
        //待完善
    }
}
