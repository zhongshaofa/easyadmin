<?php
/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\facade\Cache;


/**
 * 菜单管理
 * Class Menu
 * @package app\admin\controller
 */
class Menu extends AdminController {

    /**
     * User模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('menu');
    }

    /**
     * 菜单栏列表
     * @return mixed|\think\response\Json
     */
    public function index() {
        if (!$this->request->isPost()) {
            //ajax访问
            if ($this->request->get('type') == 'ajax') {
                $select = (array)$this->request->get('select', []);
                $menu_list = $this->model->menuList($select);
                return json($menu_list);
            }

            //基础数据
            $basic_data = [
                'status' => [
                    ['id' => 1, 'title' => '启用'],
                    ['id' => 0, 'title' => '禁用'],
                ],
                'title'  => '菜单栏管理',
                'data'   => '',
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Menu.edit_field');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit_field($post);
        }
    }

    /**
     * 添加菜单
     * @return mixed|\think\response\Json
     */
    public function add() {
        if (!$this->request->isPost()) {
            $pid = $this->request->get('pid', '');
            $basic_data = [
                'title' => '添加菜单',
            ];
            !empty($pid) && $basic_data['menu'] = ['pid' => $pid];
            $this->assign($basic_data);
            return $this->form();
        } else {
            $post = $this->request->post();
            unset($post['id']);

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Menu.add');
            if (true !== $validate) return __error($validate);
            //清空菜单缓存
            clear_menu();

            return $this->model->add($post);
        }
    }

    /**
     * 修改菜单
     * @return mixed
     */
    public function edit() {
        if (!$this->request->isPost()) {

            //查找所需修改菜单
            $menu = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($menu)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title' => '修改菜单',
                'menu'  => $menu,
            ];
            $this->assign($basic_data);

            return $this->form();
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Menu.edit');
            if (true !== $validate) return __error($validate);

            //清空菜单缓存
            clear_menu();

            return $this->model->edit($post);
        }
    }

    /**
     * 表单模板
     * @return mixed
     */
    protected function form() {

        $basic_data = [
            'up_menu' => $this->model->getUpMenu(),
        ];
        $this->assign($basic_data);

        return $this->fetch('form');
    }

    /**
     * 删除菜单
     * @return \think\response\Json
     * @throws \Exception
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin\validate\Menu.del');
            if (true !== $validate) return __error($validate);
        }

        //执行删除操作
        if (!is_array($get['id'])) {
            $del = $this->model->where('id', $get['id'])->delete();
        } else {
            $del = $this->model->whereIn('id', $get['id'])->delete();
        }

        if ($del >= 1) {

            //清空菜单缓存
            clear_menu();

            return __success('菜单删除成功！');
        } else {
            return __error('数据有误，请刷新重试！');
        }
    }

    /**
     * 更改菜单状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();
        if ($get['id'] == 1) return __error('首页不允许更改状态');
        //验证数据
        $validate = $this->validate($get, 'app\admin\validate\Menu.status');
        if (true !== $validate) return __error($validate);

        //判断菜单状态
        $status = $this->model->where('id', $get['id'])->value('status');
        if ($status == 1) {
            $msg = '菜单禁用成功';
            $status = 0;
        } else {
            $msg = '菜单启用成功';
            $status = 1;
        }

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['status' => $status]);

        if ($update >= 1) {

            //清空菜单缓存
            clear_menu();

            return __success($msg);
        } else {
            return __error('数据有误，请刷新重试！');
        }
    }
}