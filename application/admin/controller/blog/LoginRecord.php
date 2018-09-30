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

namespace app\admin\controller\blog;


use app\common\controller\AdminController;

class LoginRecord extends AdminController {

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
        $this->model = new \app\admin\model\blog\LoginRecord();
    }

    /**
     * 会员登录记录
     * @return mixed|\think\response\Json
     */
    public function index() {
        if ($this->request->get('type') == 'ajax') {
            $page = $this->request->get('page', 1);
            $limit = $this->request->get('limit', 10);
            $search = (array)$this->request->get('search', []);
            return json($this->model->getList($page, $limit, $search));
        }
        $basic_data = [
            'title' => '会员登录记录',
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();
        if (empty($get['id'])) return __error('请选择需要删除的信息');
        //执行删除操作
        return $this->model->del($get['id']);
    }
}