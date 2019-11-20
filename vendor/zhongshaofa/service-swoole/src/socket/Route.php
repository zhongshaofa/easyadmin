<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace ServiceSwoole\socket;


use EasyAdmin\console\CliEcho;
use ServiceSwoole\socket\driver\Frame;
use ServiceSwoole\socket\driver\Request;
use ServiceSwoole\socket\driver\Server;

/**
 * websocket路由跳转
 * Class Route
 * @package ServiceSwoole\socket
 */
class Route
{

    /**
     * 实例对象树
     * @var array
     */
    protected static $instanceTree = [];

    /**
     * 打开连接
     * @param $class
     * @param Request $request
     * @param $fd
     * @return bool|mixed
     */
    public static function onOpen($class, Request $request, $fd)
    {
        $instance = self::checkClass($class);
        if ($instance !== false) {
            return call_user_func_array([$instance, 'onOpen'], [$request, $fd]);
        } else {
            CliEcho::error($class . '：websocket控制器不存在');
            return false;
        }
    }

    /**
     * 接收消息
     * @param $class
     * @param Server $server
     * @param Frame $frame
     * @param Frame $message
     * @return bool|mixed
     */
    public static function onMessage($class, Server $server, Frame $frame, $message)
    {
        $instance = self::checkClass($class);
        if ($instance !== false) {
            return call_user_func_array([$instance, 'onMessage'], [$server, $frame, $message]);
        } else {
            CliEcho::error($class . 'websocket控制器不存在');
            return false;
        }
    }

    /**
     * 关闭连接
     * @param $class
     * @param Server $server
     * @param $fd
     * @return bool|mixed
     */
    public static function onClose($class, Server $server, $fd)
    {
        $instance = self::checkClass($class);
        if ($instance !== false) {
            return call_user_func_array([$instance, 'onClose'], [$server, $fd]);
        } else {
            CliEcho::error($class . 'websocket控制器不存在');
            return false;
        }
    }

    /**
     * 检测类以及获取控制器对象
     * @param $class
     * @return bool|mixed
     */
    protected static function checkClass($class)
    {
        if (!class_exists($class)) {
            return false;
        }
        if (!isset(self::$instanceTree[$class])) {
            self::$instanceTree[$class] = new $class();
        }
        return self::$instanceTree[$class];
    }

}