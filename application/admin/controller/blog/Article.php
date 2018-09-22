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
use app\common\service\AuthService;
use app\common\service\NodeService;

class Article extends AdminController {

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
        $this->model = new \app\admin\model\blog\Article;
    }

    /**
     * 文章列表
     */
    public function index() {
        echo '文章列表';
    }

    public function add() {

    }

    public function edit() {

    }

    public function del() {

    }

    public function test(){
        dump($this->request->controller());
        dump(AuthService::parseNodeStr('admin/blog.Article'));
//        dump(NodeService::cleanNode());
        dump(NodeService::refreshNode());
//        dump(NodeService::getNodeList());
    }
}