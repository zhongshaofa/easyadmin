<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 2:25
 */

namespace app\admin_blog\controller;


use app\common\controller\AdminController;

/**
 * 会员管理
 * Class Member
 * @package app\admin_blog\controller
 */
class Member extends AdminController {


    /**
     * 默认模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = new \app\admin_blog\model\Member();
    }

    /**
     * 会员列表
     * @return mixed|\think\response\Json
     */
    public function index() {
        if ($this->request->get('type') == 'ajax') {
            $page = $this->request->get('page', 1);
            $limit = $this->request->get('limit', 10);
            $search = (array)$this->request->get('search', []);
            return json($this->model->getMemberList($page, $limit, $search));
        }
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
            $basic_data = [
                'title' => '添加会员',
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin_blog\validate\Member.add');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            $post['password'] = password($post['password']);
            unset($post['password1']);
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
            $member = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($member)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title'  => '修改会员信息',
                'member' => $member->hidden(['password']),
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin_blog\validate\Member.edit');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit($post);
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
     * 删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin_blog\validate\Member.del');
            if (true !== $validate) return __error($validate);
        }

        //执行删除操作
        if (!is_array($get['id'])) {
            $del = $this->model->where('id', $get['id'])->update(['is_deleted' => 1]);
        } else {
            $del = $this->model->whereIn('id', $get['id'])->update(['is_deleted' => 1]);
        }
        if ($del >= 1) {
            return __success('删除成功！');
        } else {
            return __error('数据有误，请刷新重试！');
        }
    }

    /**
     * 更改状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin_blog\validate\Member.status');
        if (true !== $validate) return __error($validate);

        //判断状态
        $status = $this->model->where('id', $get['id'])->value('status');
        $status == 1 ? list($msg, $status) = ['启用成功', $status = 0] : list($msg, $status) = ['禁用成功', $status = 1];

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['status' => $status]);


        if ($update >= 1) return __success($msg);
        return __error('数据有误，请刷新重试！');
    }

}