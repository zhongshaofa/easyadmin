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

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\facade\Cache;

class Auth extends AdminController {

    /**
     * Auth模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * node constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('auth');
    }

    /**
     * 角色列表
     */
    public function index() {
        if (!$this->request->isPost()) {

            //ajax访问获取数据
            if ($this->request->get('type') == 'ajax') {
                $page = $this->request->get('page', 1);
                $limit = $this->request->get('limit', 10);
                $search = (array)$this->request->get('search', []);
                return json($this->model->authList($page, $limit, $search));
            }

            //基础数据
            $basic_data = [
                'title'  => '系统角色列表',
                'data'   => '',
                'status' => [['id' => 1, 'title' => '启用'], ['id' => 0, 'title' => '禁用']],
            ];

            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Auth.edit_field');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit_field($post);
        }
    }

    /**
     * 添加角色
     * @return mixed|\think\response\Json
     */
    public function add() {
        if (!$this->request->isPost()) {

            //基础数据
            $basic_data = [
                'title' => '添加角色',
            ];
            $this->assign($basic_data);

            return $this->form();
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Auth.add');
            if (true !== $validate) return __error($validate);

            //清空缓存
            clear_menu();

            //保存数据,返回结果
            return $this->model->add($post);
        }
    }

    /**
     * 修改管理员信息
     * @return mixed|string|\think\response\Json
     */
    public function edit() {
        if (!$this->request->isPost()) {

            //查找所需修改角色
            $auth = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($auth)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title' => '修改角色信息',
                'auth'  => $auth,
            ];
            $this->assign($basic_data);

            return $this->form();
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Auth.edit');
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
     * 删除角色
     * @return \think\response\Json
     * @throws \Exception
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin\validate\Auth.del');
            if (true !== $validate) return __error($validate);
        }

        //执行更新操作操作
        if (!is_array($get['id'])) {
            $del = $this->model->where('id', $get['id'])->delete();
            model('auth_node')->where('auth', $get['id'])->delete();
        } else {
            $del = $this->model->whereIn('id', $get['id'])->delete();
            model('auth_node')->whereIn('auth', $get['id'])->delete();
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
     * 更改角色状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin\validate\Auth.status');
        if (true !== $validate) return __error($validate);

        //判断菜单状态
        $status = $this->model->where('id', $get['id'])->value('status');
        $status == 1 ? list($msg, $status) = ['角色禁用成功', $status = 0] : list($msg, $status) = ['角色启用成功', $status = 1];

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['status' => $status]);

        //清空菜单缓存
        clear_menu();

        if ($update >= 1) return __success($msg);
        return __error('数据有误，请刷新重试！');
    }

    /**
     * 授权信息
     * @return mixed|string|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function authorize() {
        if (!$this->request->isPost()) {

            //查找所需授权角色
            $auth = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($auth)) return msg_error('暂无数据，请重新刷新页面！');

            $node = model('node')->where(['is_auth' => 1])->order('node asc')->select();

            $auth_node = model('auth_node')->where(['auth' => $auth['id']])->select();

            foreach ($node as &$vo) {
                $i = 0;
                foreach ($auth_node as $al) {
                    $vo['id'] == $al['node'] && $i++;
                }
                $i == 0 ? $vo['is_checked'] = false : $vo['is_checked'] = true;
            }

            //基础数据
            $basic_data = [
                'title' => '角色授权',
                'auth'  => $auth,
                'node'  => $node,
            ];
            $this->assign($basic_data);

            return $this->fetch();
        } else {
            $post = $this->request->post();
            empty($post['node_id']) && $post['node_id'] = [];

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Auth.authorize');
            if (true !== $validate) return __error($validate);

            $insertAll = [];
            foreach ($post['node_id'] as $vo) {
                $insertAll[] = [
                    'auth' => $post['auth_id'],
                    'node' => $vo,
                ];
            }

            //清空菜单缓存
            clear_menu();

            //清空旧数据
            model('auth_node')->where(['auth' => $post['auth_id']])->delete();
            //保存数据,返回结果
            return model('auth_node')->authorize($insertAll);
        }
    }
}