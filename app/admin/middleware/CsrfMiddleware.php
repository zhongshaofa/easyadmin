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


use app\Request;
use CsrfVerify\drive\ThinkphpCache;
use CsrfVerify\entity\CsrfVerifyEntity;
use CsrfVerify\interfaces\CsrfVerifyInterface;
use think\facade\Session;

class CsrfMiddleware
{
    use \app\common\traits\JumpTrait;

    public function handle(Request $request, \Closure $next)
    {
        if (env('EASYADMIN.IS_CSRF', true)) {
            if (!in_array($request->method(), ['GET', 'HEAD', 'OPTIONS'])) {

                // 跨域校验
                $refererUrl = $request->header('REFERER', null);
                $refererInfo = parse_url($refererUrl);
                $host = $request->host();
                if (!isset($refererInfo['host']) || $refererInfo['host'] != $host) {
                    $this->error('当前请求不合法！');
                }

                // CSRF校验
                $check = $request->checkToken();
                if (!$check) {
                    $this->error('请求验证失败，请重新刷新页面！');
                }

            }
        }
        return $next($request);
    }
}