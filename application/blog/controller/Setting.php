<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\blog\controller;


use app\blog\model\LoginRecord;
use app\common\controller\BlogController;
use think\Db;

/**
 * 个人设置
 * Class Setting
 * @package app\blog\controller
 */
class Setting extends BlogController {

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = true;

    /**
     * 初始化
     * Member constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Member');
    }

    /**
     * 账号绑定
     * @return mixed
     */
    public function index() {
        $basic_data = [
            'title'       => '账号绑定',
            'nav_top'     => 'setting',
            'member_info' => $this->model->where(['id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0])->find(),
            'last_time'   => model('LoginRecord')->getLastTime($this->member['id']),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 用户信息
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function info() {
        $basic_data = [
            'title'       => '用户信息',
            'nav_top'     => 'setting_info',
            'member_info' => $this->model->where(['id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0])->find(),
            'last_time'   => model('LoginRecord')->getLastTime($this->member['id']),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 登录日志
     * @return mixed
     */
    public function login_log() {
        $basic_data = [
            'title'        => '登录日志',
            'nav_top'      => 'operat_log',
            'login_record' => model('LoginRecord')->getMemberList($this->member['id']),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 修改用户信息
     * @return mixed
     */
    public function form_info() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'member_info' => 'member_info',
            ];
            return $this->fetch('setting/form/info', $basic_data);
        } else {

        }
    }


    /**
     * 修改用户账号
     * @return mixed
     */
    public function form_username() {
        if (!$this->request->isPost()) {
            $info = $this->model->getMemberInfo($this->member['id']);
            if (empty($info)) return msg_error('信息有误，请稍后再试！', url('@blog/setting'));
            $basic_data = [
                'info' => $info,
            ];
            return $this->fetch('setting/form/username', $basic_data);
        } else {

        }
    }

    /**
     * 修改邮箱
     * @return mixed
     */
    public function form_email() {
        if (!$this->request->isPost()) {
            $info = $this->model->getMemberInfo($this->member['id']);
            if (empty($info)) return msg_error('信息有误，请稍后再试！', url('@blog/setting'));
            $basic_data = [
                'member_info' => $info,
            ];
            return $this->fetch('setting/form/email', $basic_data);
        } else {
            $post = $this->request->post();
            $validate = $this->validate($post, 'app\blog\validate\Setting.FormEmail');
            if (true !== $validate) return __error($validate);
            return __success('保存成功！');
        }
    }

    /**
     * 修改手机
     * @return mixed
     */
    public function form_phone() {
        if (!$this->request->isPost()) {
            $info = $this->model->getMemberInfo($this->member['id']);
            if (empty($info)) return msg_error('信息有误，请稍后再试！', url('@blog/setting'));
            $basic_data = [
                'member_info' => $info,
            ];
            return $this->fetch('setting/form/phone', $basic_data);
        } else {

        }
    }

    /**
     * 修改密码
     * @return mixed
     */
    public function form_password() {
        if (!$this->request->isPost()) {
            $info = $this->model->getMemberInfo($this->member['id']);
            if (empty($info)) return msg_error('信息有误，请稍后再试！', url('@blog/setting'));
            $basic_data = [
                'member_info' => $info,
            ];
            return $this->fetch('setting/form/password', $basic_data);
        } else {

        }
    }

    /**
     * 编辑个人信息
     * @return mixed
     */
    public function form_info2() {
        $basic_data = [
            'title'       => '用户信息',
            'nav_top'     => 'setting_info',
            'member_info' => $this->model->where(['id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0])->find(),
            'last_time'   => model('LoginRecord')->getLastTime($this->member['id']),
        ];
        return $this->fetch('setting/form/info', $basic_data);

    }

    /**
     * 修改个人信息
     * @return mixed
     */
    public function edit_info() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'title'       => '修改用户信息',
                'member_info' => $this->model->where(['id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0])->find(),
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();
            $post['id'] = $this->member['id'];

            //验证数据
            $validate = $this->validate($post, 'app\blog\validate\Setting.edit_info');
            if (true !== $validate) return __error($validate);


            //保存数据,返回结果
            return $this->model->updateSelf($post);
        }
    }

}