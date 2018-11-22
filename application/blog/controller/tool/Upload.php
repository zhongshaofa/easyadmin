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

namespace app\blog\controller\tool;


use app\common\controller\BlogController;

/**
 * 上传图片插件
 * Class Upload
 * @package app\blog\controller\tool
 */
class Upload extends BlogController {

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
    }

    /**
     * 上传图片
     * @param string $type ['multi','one']
     * @return mixed
     */
    public function image($type = 'one') {
        return $this->fetch('', ['type' => $type]);
    }
}