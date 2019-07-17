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
        View::assign([
            'thisModule'     => $thisModule,
            'thisController' => parse_name($thisController),
            'thisAction'     => parse_name($thisAction),
            'thisRequest'    => parse_name("{$thisModule}/{$thisController}/{$thisAction}"),
        ]);
        return $next($request);
    }

}