<?php

namespace addons\answer\controller;


use app\admin\service\ConfigService;
use app\BaseController;
use app\common\constants\AdminConstant;
use app\common\service\AuthService;
use EasyAdmin\tool\CommonTool;
use think\facade\Env;
use think\facade\View;
use think\Model;

/**
 * Class AdminController
 * @package app\common\controller
 */
class AnswerHomeController extends BaseController
{

    use \app\common\traits\JumpTrait;

    /**
     * 当前模型
     * @Model
     * @var object
     */
    protected $model;

    /**
     * 服务类
     * @var object
     */
    protected $service;

    /**
     * 模板布局, false取消
     * @var string|bool
     */
    protected $layout = 'home/layout/default';

    /**
     * 判断是否检测后台登录
     * @var bool
     */
    protected $isLogin = true;

    /**
     * 判断是否检测权限判断
     * @var bool
     */
    protected $isAuth = true;

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $this->layout && $this->app->view->engine()->layout($this->layout);
        $this->viewInit();
    }

    /**
     * 初始化模板变量
     */
    protected function viewInit()
    {
        $data = [
            'version' => env('app_debug') ? time() : ConfigService::getVersion(),
        ];
        View::assign($data);
    }

    /**
     * 模板变量赋值
     * @param string|array $name 模板变量
     * @param mixed $value 变量值
     * @return mixed
     */
    public function assign($name, $value = null)
    {
        return $this->app->view->assign($name, $value);
    }

    /**
     * 解析和获取模板内容 用于输出
     * @param string $template
     * @param array $vars
     * @return mixed
     */
    public function fetch($template = '', $vars = [])
    {
        return $this->app->view->fetch($template, $vars);
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