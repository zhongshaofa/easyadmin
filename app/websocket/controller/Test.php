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

namespace app\websocket\controller;


use ServiceSwoole\socket\driver\Frame;
use ServiceSwoole\socket\driver\Request;
use ServiceSwoole\socket\driver\Server;

class Test
{

    public function onHandShake()
    {

    }

    public function onOpen(Request $request, $fd)
    {
        dump('---------连接成功1-----------');
//        dump($request);
    }

    public function onMessage(Server $server, Frame $frame, $message)
    {

    }

    public function onClose(Server $server, $fd)
    {

    }

}