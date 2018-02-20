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

        if (!$config = &Config::$config) {
            $config = Yaf_Application::app()->getConfig()->toArray();
        }
        //如果为空，返回所有的配置
        if ($key == null) {
            return $config;
        }
        // 非二级配置时直接返回
        if (!strpos($key, '.')) {
            $name = strtolower($key);
            $value = $config[$name];
            return null === $value ? $default : $value;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $key, 2);
        $name[0] = strtolower($name[0]);
        return isset(self::$config[$name[0]][$name[1]]) ? self::$config[$name[0]][$name[1]] : $default;
    }
}
