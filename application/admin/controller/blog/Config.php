<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 23:00
 */

namespace app\admin\controller\blog;


use app\common\controller\AdminController;

/**
 * 博客配置控制器
 * Class Config
 * @package app\admin\controller\blog
 */
class Config extends AdminController
{

    /**
     * config模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * node constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new \app\admin\model\blog\Config;
    }

    /**
     * 系统配置信息列表
     */
    public function index()
    {
        if (!$this->request->isPost()) {

            //基础数据
            $basic_data = [
                'title' => '博客配置列表',
                'data'  => $this->model->getDataList(),
            ];
            $this->assign($basic_data);

            return $this->fetch('');
        } else {
            $post = $this->request->post();
            return $this->model->editDataList($post);
        }
    }
}