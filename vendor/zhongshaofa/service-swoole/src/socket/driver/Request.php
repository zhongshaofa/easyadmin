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

namespace ServiceSwoole\socket\driver;


use EasyAdmin\tool\CommonTool;

class Request
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
        return $this;
    }

    public function fd()
    {
        return $this->request->fd;
    }

    public function uri()
    {
        return $this->request->server['request_uri'];
    }

    public function server()
    {
        return $this->request->server;
    }

    public function header()
    {
        return $this->request->header;
    }

    public function getController($namespace)
    {
        $uri = $this->request->server['request_uri'];
        if ($uri == '/') {
            return false;
        }
        $uriArray = explode('/', $uri);
        end($uriArray);
        $key = key($uriArray);
        $uriArray[$key] = CommonTool::lineToHump(ucfirst($uriArray[$key]));
        return $namespace . implode('\\', $uriArray);
    }

}