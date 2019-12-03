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

namespace EasyAddons\middleware;


use app\common\constants\AdminConstant;
use app\common\service\AuthService;
use EasyAddons\driver\Tool;
use think\App;
use think\facade\Cache;
use think\facade\Env;
use think\facade\Request;
use think\facade\View;

class ViewInit
{

    public function handle($request, \Closure $next)
    {
        list($thisModule, $thisController, $thisAction) = Tool::getRoutePositionByDispatch(app('route')->check()->getDispatch());
        $autoloadJs = file_exists("static/addons/{$thisModule}/js/{$thisController}.js") ? true : false;
        $thisControllerJsPath = "addons/{$thisModule}/js/{$thisController}.js";
        $adminModuleName = Env::get('easyadmin.admin', 'admin');
        // 获取所有授权的节点
        $allAuthNode = Cache::get('allAuthNode_' . session('admin.id'));
        if (empty($allAuthNode)) {
            $allAuthNode = (new AuthService(session('admin.id')))->getAdminNode();
            Cache::tag('authNode')->set('allAuthNode_' . session('admin.id'), $allAuthNode);
        }
        $isSuperAdmin = session('admin.id') == AdminConstant::SUPER_ADMIN_ID ? true : false;
        $data = [
            'admin_module_name'    => $adminModuleName,
            'thisController'       => parse_name($thisController),
            'thisAction'           => parse_name($thisAction),
            'thisRequest'          => parse_name("addons/{$thisModule}/{$thisController}/{$thisAction}"),
            'thisControllerJsPath' => "{$thisControllerJsPath}",
            'autoloadJs'           => $autoloadJs,
            'allAuthNode'          => $allAuthNode,
            'isSuperAdmin'         => $isSuperAdmin,
        ];
        View::assign($data);
        $request->adminModuleName = $adminModuleName;
        return $next($request);
    }


}