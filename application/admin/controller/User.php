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


class User extends AdminController {

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
        $this->model = model('user');
    }

    /**
     * 管理员列表
     */
    public function index() {

        //ajax访问
        if ($this->request->get('type') == 'ajax') {
            $page = $this->request->get('page', 1);
            $limit = $this->request->get('limit', 10);
            $search = (array)$this->request->get('search', []);
            return json($this->model->userList($page, $limit, $search));
        }

        //基础数据
        $basic_data = [
            'title' => '管理员列表',
            'data'  => '',
        ];

        return $this->fetch('', $basic_data);
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add() {
        if (!$this->request->isPost()) {

            //基础数据
            $basic_data = [
                'title' => '添加管理员',
                'auth'  => model('auth')->getList(),
            ];
            $this->assign($basic_data);

            return $this->form();
        } else {
            $post = $this->request->post();
            !isset($post['auth_id']) && $post['auth_id'] = [];
            //数组转json
            $post['auth_id'] = json_encode($post['auth_id']);

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\User.add');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            $post['password'] = password($post['password']);
            return $this->model->add($post);
        }
    }

    /**
     * 修改管理员信息
     * @return mixed|string|\think\response\Json
     */
    public function edit() {
        if (!$this->request->isPost()) {

            //查找所需修改用户
            $user = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($user)) return msg_error('暂无数据，请重新刷新页面！');

            $auth = model('auth')->getList()->toArray();

            $auth_id = json_decode($user['auth_id'], true);

            foreach ($auth as $k => $val) {
                $is_checked = false;
                foreach ($auth_id as $k_1) $val['id'] == $k_1 && $is_checked = true;
                $auth[$k]['is_checked'] = $is_checked;
            }

            //基础数据
            $basic_data = [
                'title' => '修改管理员信息',
                'user'  => $user->hidden(['password']),
                'auth'  => $auth,
            ];
            $this->assign($basic_data);

            return $this->form();
        } else {
            $post = $this->request->post();
            !isset($post['auth_id']) && $post['auth_id'] = [];
            //数组转json
            $post['auth_id'] = json_encode($post['auth_id']);

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\User.edit');
            if (true !== $validate) return __error($validate);

            //清空菜单缓存
            clear_menu();

            //保存数据,返回结果
            return $this->model->edit($post);
        }
    }

    /**
     * 表单模板
     * @return mixed
     */
    protected function form() {
        return $this->fetch('form');
    }

    /**
     * 管理员的删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin\validate\User.del');
            if (true !== $validate) return __error($validate);
        }

        //执行删除操作
        if (!is_array($get['id'])) {
            $del = $this->model->where('id', $get['id'])->update(['is_deleted' => 1]);
        } else {
            $del = $this->model->whereIn('id', $get['id'])->update(['is_deleted' => 1]);
        }

        if ($del >= 1) {

            //清空菜单缓存
            clear_menu();

            return __success('删除成功！');
        } else {
            return __error('数据有误，请刷新重试！');
        }
    }

    /**
     * 修改用户密码
     * @return mixed|string|\think\response\Json
     */
    public function edit_password() {
        if (!$this->request->isPost()) {
            if (empty($this->request->get('id'))) return msg_error('暂无用户信息！');
            $where_user = [
                'id'         => $this->request->get('id'),
                'is_deleted' => 0,
            ];
            $user = $this->model->where($where_user)->field('id, username')->find();
            if (empty($user)) return msg_error('暂无用户信息，请关闭页面刷新重试！');
            $basic_data = [
                'title' => '修改管理员密码',
                'user'  => $user,
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\User.edit_password');
            if (true !== $validate) return __error($validate);

            //修改密码数据
            return $this->model->editPassword($post);
        }
    }

    /**
     * 更改管理员状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin\validate\User.status');
        if (true !== $validate) return __error($validate);

        //判断管理员状态
        $status = $this->model->where('id', $get['id'])->value('status');
        $status == 1 ? list($msg, $status) = ['禁用成功', $status = 0] : list($msg, $status) = ['启用成功', $status = 1];

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['status' => $status]);

        //清空菜单缓存
        clear_menu();

        if ($update >= 1) return __success($msg);
        return __error('数据有误，请刷新重试！');
    }

    /**
     * 修改自己的信息
     * @return mixed|string|\think\response\Json
     */
    public function edit_self() {
        if (!$this->request->isPost()) {

            //查找所需修改用户
            $user = $this->model->where('id', $this->user['id'])->find();
            if (empty($user)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title' => '修改管理员信息',
                'user'  => $user->hidden(['password']),
            ];
            $this->assign($basic_data);

            return $this->fetch('form_self');
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\User.edit_self');
            if (true !== $validate) return __error($validate);

            //清空菜单缓存
            clear_menu();

            //保存数据,返回结果
            return $this->model->editSelf($post);
        }
    }

}