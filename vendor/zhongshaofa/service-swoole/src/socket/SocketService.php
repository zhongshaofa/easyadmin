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
use ServiceSwoole\socket\driver\Request;

class SocketService
{

    protected $server;

    protected $port = 18888;

    protected $controllerDir;

    protected $namespaceBase;

    protected $loadTree = [];

    public function __construct($port, $namespaceBase, $controllerDir)
    {
        $this->port = $port;
        $this->namespaceBase = $namespaceBase;
        $this->controllerDir = $controllerDir;
        $this->server = new \Swoole\WebSocket\Server("0.0.0.0", $this->port);
        return $this;
    }

    public function run()
    {
        CliEcho::success("执行socket");
        $this->server->on('open', function (\Swoole\WebSocket\Server $server, $request) {
            $request = new Request($request);
            $class = $request->getController($this->namespaceBase);
            Route::onOpen($class, $request, $request->fd());
        });
        $server =  $this->server;
        $this->server->on('message', function (\Swoole\WebSocket\Server $server, $frame) {
//            dump($server);
//            dump($frame);
            dump($frame);
//            $request = new \Swoole\Http\Request();
//            dump($request);
            $data = $frame->data;
            $server->push($frame->fd, "发送的消息为1：" . $frame->data);
        });
        $this->server->on('close', function (\Swoole\WebSocket\Server $server, $fd) {
            dump($server);
            echo "client {$fd} closed\n";
        });
        $this->server->start();
    }



}