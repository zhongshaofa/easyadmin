<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1
 * Time: 1:44
 */

namespace app\cache\controller;


use think\Controller;

class Clean extends Controller {

    /**
     * 刷新缓存
     * @param string $password
     * @return string
     */
    public function index($password = '') {
        $CleanCachePassword = \app\admin\model\Config::where(['name' => 'CleanCachePassword', 'group' => 'basic'])->value('value');
        if ($password == $CleanCachePassword) {
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