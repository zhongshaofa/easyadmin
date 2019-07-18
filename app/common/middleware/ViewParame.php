<?php


namespace app\common\middleware;

use think\facade\View;

/**
 * 渲染模板常量
 * Class View
 * @package app\common\middleware
 */
class ViewParame
{

    public function handle($request, \Closure $next)
    {
        list($thisModule, $thisController, $thisAction) = [
            $request->app(),
            $request->controller(),
            $request->action(),
        ];

        list($thisControllerArr, $jsPath) = [explode('.', $thisController), null];
        foreach ($thisControllerArr as $vo) {
            if (empty($jsPath)) {
                $jsPath = parse_name($vo);
            } else {
                $jsPath .= '/' . parse_name($vo);
            }
        }

        View::assign([
            'thisModule'           => $thisModule,
            'thisController'       => parse_name($thisController),
            'thisAction'           => parse_name($thisAction),
            'thisRequest'          => parse_name("{$thisModule}/{$thisController}/{$thisAction}"),
            'thisControllerJsPath' => "{$thisModule}/js/{$jsPath}",
        ]);

        return $next($request);
    }

}