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

class CsrfMiddleware
{
    use \app\common\traits\JumpTrait;

    public function handle(Request $request, \Closure $next)
    {
        $refererUrl = $request->header('REFERER', null);
        $refererInfo = parse_url($refererUrl);
        $host = $request->host();
        if (!env('APP_DEBUG', false)) {
            if (!isset($refererInfo['host']) || $refererInfo['host'] != $host) {
                $this->error('无效请求！');
            }

            if ($request->isAjax()) {
                $token = $request->header('EASYADMIN-CSRF-TOKEN', null);
                if (empty($token)) {
                    $this->error('无效请求！');
                }

                /** @var CsrfVerifyInterface $service */
                $service = app(CsrfVerifyInterface::class);

                $verify = $service->verify($token, new CsrfVerifyEntity(
                    env('CSRF.MARK', 'CSRF_MARK'),
                    env('CSRF.SECRET', 'CSRF_SECRET')
                ), new ThinkphpCache());

                if (!$verify) {
                    $this->error('请求验证失败，请刷新页面！');
                }
            }
        }
        return $next($request);
    }
}