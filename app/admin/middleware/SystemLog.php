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

namespace app\admin\middleware;

use app\admin\service\SystemLogService;
use EasyAdmin\tool\CommonTool;

/**
 * 系统操作日志中间件
 * Class SystemLog
 * @package app\admin\middleware
 */
class SystemLog
{

    public function handle($request, \Closure $next)
    {
        if($request->isAjax()){
            $url = $request->url();
            $method = $request->method();
            $params = $request->param();
            $ip = CommonTool::getRealIp();
            $data = [
                'admin_id'    => session('admin.id'),
                'url'         => $url,
                'method'      => strtolower($method),
                'ip'          => $ip,
                'content'     => json_encode($params, JSON_UNESCAPED_UNICODE),
                'useragent'   => $_SERVER['HTTP_USER_AGENT'],
                'create_time' => time(),
            ];
            SystemLogService::instance()->save($data);
        }
        return $next($request);
    }

}