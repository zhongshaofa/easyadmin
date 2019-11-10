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

use app\common\service\AuthService;

/**
 * 检测用户登录和节点权限
 * Class CheckAdmin
 * @package app\admin\middleware
 */
class CheckAdmin
{

    use \app\common\traits\JumpTrait;

    /**
     * 不需要验证登录的控制器
     * @var array
     */
    protected $noLoginController = [
        'login',
    ];

    /**
     * 不需要验证登录的节点
     * @var array
     */
    protected $noLoginNode = [
        'login/index',
        'login/out',
    ];

    /**
     * 不需要验证权限的控制器
     * @var array
     */
    protected $noAuthController = [
        'ajax',
        'login',
        'index',
    ];

    /**
     * 不需要验证权限的节点
     * @var array
     */
    protected $noAuthNode = [
        'login/index',
        'login/out',
    ];

    public function handle($request, \Closure $next)
    {
        $adminId = session('admin.id');
        $authService = new AuthService($adminId);
        $currentNode = $authService->getCurrentNode();
        $currentController = parse_name($request->controller());

        // 验证登录
        if (!in_array($currentController, $this->noLoginController) &&
            !in_array($currentNode, $this->noLoginNode)) {
            empty($adminId) && $this->error('请先登录后台', [], __url('login/index'));
        }

        // 验证权限
        if (!in_array($currentController, $this->noAuthController) &&
            !in_array($currentNode, $this->noAuthNode)) {
            $check = $authService->checkNode($currentNode);
            !$check && $this->error('暂无权限访问该页面，请联系超级管理员');
        }

        return $next($request);
    }

}