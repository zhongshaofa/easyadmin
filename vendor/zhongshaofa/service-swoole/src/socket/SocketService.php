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

class SocketService
{

    protected $port = 18888;

    public function __construct($port = 18888)
    {
        $this->port = $port;
        return $this;
    }

    public function run()
    {
        CliEcho::success("执行socket");
        $server = new \Swoole\WebSocket\Server("0.0.0.0", $this->port);
        $server->on('open', function (\Swoole\WebSocket\Server $server, $request) {
            dump($server);
            dump($request);
        });
        $server->on('message', function (\Swoole\WebSocket\Server $server, $frame) {
            dump($server);
            dump($frame);
            $server->push($frame->fd, "this is server");
        });
        $server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
            CliEcho::success("结束socket");
        });
        $server->start();
    }
}