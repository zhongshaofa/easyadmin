<?php

//declare (strict_types = 1);

namespace app\common\controller;

use think\App;
use think\facade\Validate;

/**
 * 后台基础控制器
 */
abstract class AdBaseController
{

    use \app\common\traits\AdminTrait;
    use \app\common\traits\JumpTrait;

    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否检测登录
     * @var bool
     */
    protected $isLogin = true;

    /**
     * 所有请求的参数
     * @var array
     */
    protected $parame = [];

    /**
     * 选中所需要的参数
     */
    protected $selectParame = [];

    /**
     * 当前逻辑对象
     * @var
     */
    protected $logic;

    /**
     * 用户ID
     * @var
     */
    protected $adminId;

    /**
     * 构造方法
     * @access public
     * @param App $app 应用对象
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;
        $this->parame = $this->request->param();
        $this->initialize();
    }

    /**
     * 初始化
     */
    protected function initialize()
    {
        if ($this->isLogin) {
            $this->checkLogin();
        }
    }

    /**
     * 检查是否登录
     */
    protected function checkLogin()
    {
        $admin = session('admin');
        if (empty($admin)) {
            $this->error('请先登录再操作', url_build('admin/login/index'));
        }
        $this->adminId = session('admin.id');
    }

    /**
     * 检测参数
     * @param $rule
     * @return bool
     */
    public function validate($rule)
    {
        $validate = Validate::rule($rule);
        if (!$validate->check($this->parame)) {
            return $validate->getError();
        } else {
            return true;
        }
    }

    /**
     * 设置选中需要的参数
     * @param $param
     * @return array
     */
    public function setSelectParam($param)
    {
        foreach ($param as $vo) {
            if (isset($this->parame[$vo])) {
                $this->selectParame[$vo] = $this->parame[$vo];
            } else {
                $this->error("参数{$vo}不能为空");
            }
        }
        return $this->selectParame;
    }

}
