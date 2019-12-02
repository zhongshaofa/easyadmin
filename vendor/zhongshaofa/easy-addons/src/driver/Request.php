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
namespace EasyAddons\driver;

use think\App;
use think\facade\Config;
use think\Request as BaseRequest;

class Request extends BaseRequest
{
    /**
     * 当前模块名
     * @var string
     */
    protected $module;

    /**
     * 重写controller方法
     * @param bool $convert
     * @return string
     */
    public function controller(bool $convert = false): string
    {
        $this->url();
        return $this->controller;
    }

    /**
     * 重写action方法
     * @param bool $convert
     * @return string
     */
    public function action(bool $convert = false): string
    {
        $this->url();
        return $this->action;
    }

    /**
     * 重写url方法
     * @param bool $complete
     * @return string
     */
    public function url(bool $complete = false): string
    {
        $this->url = parent::url($complete);
        $url = substr($this->url, 1);
        $urlArray = explode('/', $url);
        $this->module = isset($urlArray[1]) ? $urlArray[1] : null;
        if (count($urlArray) == 3) {
            $this->controller = humpToLine(lcfirst(end($urlArray)));
            $this->action = Config::get('addons.default_action');
        } elseif (count($urlArray) > 3) {
            $controllerArray = array_slice($urlArray, 2, -1);
            $controllerArray[count($controllerArray) - 1] = lcfirst($controllerArray[count($controllerArray) - 1]);
            $this->controller = implode(DIRECTORY_SEPARATOR, $controllerArray);
            $this->action = end($urlArray);
        }
        return $this->url;
    }

    /**
     * 获取当前模块名
     * @return |mixed
     */
    public function module()
    {
        $this->url();
        return $this->module;
    }
}