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


namespace app\common\controller;


use app\BaseController;
use think\Model;
use think\facade\View;

/**
 * Class AdminController
 * @package app\common\controller
 */
class AdminController extends BaseController
{

    use \app\common\traits\JumpTrait;

    /**
     * 当前模型
     * @var object
     */
    protected $model;


    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

    }

    /**
     * 模板变量赋值
     * @param string|array $name 模板变量
     * @param mixed $value 变量值
     * @return View
     */
    public function assign($name, $value = null)
    {
        return View::assign($name, $value);
    }

    /**
     * 解析和获取模板内容 用于输出
     * @param string $template
     * @param array $vars
     * @return string
     * @throws \Exception
     */
    public function fetch($template = '', $vars = [])
    {
        return View::fetch($template, $vars);
    }

    /**
     * 重写验证规则
     * @param array $data
     * @param array|string $validate
     * @param array $message
     * @param bool $batch
     * @return array|bool|string|true
     */
    public function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        try {
            parent::validate($data, $validate, $message, $batch);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        return true;
    }

}