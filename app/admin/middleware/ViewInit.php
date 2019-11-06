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


use think\App;
use think\facade\Env;
use think\facade\Request;
use think\facade\View;
use think\route\dispatch\Controller;

class ViewInit
{

    public function handle($request, \Closure $next)
    {
        list($thisModule, $thisController, $thisAction) = [app('http')->getName(), Request::controller(), $request->action()];
        list($thisControllerArr, $jsPath) = [explode('.', $thisController), null];
        foreach ($thisControllerArr as $vo) {
            empty($jsPath) ? $jsPath = parse_name($vo) : $jsPath .= '/' . parse_name($vo);
        }
        $thisControllerJsPath = "static/{$thisModule}/js/{$jsPath}.js";
        $autoloadJs           = file_exists($thisControllerJsPath) ? true : false;
        $adminModuleName      = Env::get('easyadmin.admin', 'admin');
        $data                 = [
            'admin_module_name'    => $adminModuleName,
            'thisController'       => parse_name($thisController),
            'thisAction'           => parse_name($thisAction),
            'thisRequest'          => parse_name("{$thisModule}/{$thisController}/{$thisAction}"),
            'thisControllerJsPath' => "/{$thisControllerJsPath}",
            'autoloadJs'           => $autoloadJs,
        ];
        View::assign($data);
        return $next($request);
    }


}