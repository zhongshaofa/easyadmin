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

namespace app\cache\controller;


use think\Controller;

/**
 * 缓存管理
 * Class Index
 * @package app\cache\controller
 */
class Index extends Controller {

    /**
     * 刷新缓存
     * @param string $password
     * @return string
     */
    public function index($password = '') {
        if ($password == 'chung') {
            if (app('cache')->clear()) {
                echo '缓存刷新成功';
                return msg_success('缓存刷新成功！');
            } else {
                echo '缓存刷新失败';
                return msg_error('缓存刷新失败！');
            }
        } else {
            return msg_error('这里什么都没有啊');
        }
    }
}