<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

use Think\Component\Request\Facade\Request;

if (!function_exists('request')) {
    /**
     * 获取当前Request对象实例
     * @return Think\Component\Request\Request
     */
    function request(): Think\Component\Request\Request
    {
        return app('Think\Component\Request\Request');
    }
}

if (!function_exists('input')) {
    /**
     * 获取输入数据 支持默认值和过滤
     * @param string $key     获取的变量名
     * @param mixed  $default 默认值
     * @param string $filter  过滤方法
     * @return mixed
     */
    function input(string $key = '', $default = null, $filter = '')
    {
        if (0 === strpos($key, '?')) {
            $key = substr($key, 1);
            $has = true;
        }

        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            $method = substr($key, 0, $pos);
            if (in_array($method, ['get', 'post', 'put', 'patch', 'delete', 'route', 'param', 'request', 'session', 'cookie', 'server', 'env', 'path', 'file'])) {
                $key = substr($key, $pos + 1);
                if ('server' == $method && is_null($default)) {
                    $default = '';
                }
            } else {
                $method = 'param';
            }
        } else {
            // 默认为自动判断
            $method = 'param';
        }

        return isset($has) ?
            request()->has($key, $method) :
            request()->$method($key, $default, $filter);
    }
}

if (!function_exists('token')) {
    /**
     * 获取Token令牌
     * @param string $name 令牌名称
     * @param mixed  $type 令牌生成方法
     * @return string
     */
    function token(string $name = '__token__', string $type = 'md5'): string
    {
        return Request::buildToken($name, $type);
    }
}

if (!function_exists('token_field')) {
    /**
     * 生成令牌隐藏表单
     * @param string $name 令牌名称
     * @param mixed  $type 令牌生成方法
     * @return string
     */
    function token_field(string $name = '__token__', string $type = 'md5'): string
    {
        $token = Request::buildToken($name, $type);

        return '<input type="hidden" name="' . $name . '" value="' . $token . '" />';
    }
}

if (!function_exists('token_meta')) {
    /**
     * 生成令牌meta
     * @param string $name 令牌名称
     * @param mixed  $type 令牌生成方法
     * @return string
     */
    function token_meta(string $name = '__token__', string $type = 'md5'): string
    {
        $token = Request::buildToken($name, $type);

        return '<meta name="csrf-token" content="' . $token . '">';
    }
}