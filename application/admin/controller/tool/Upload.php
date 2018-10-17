<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15
 * Time: 21:58
 */

namespace app\admin\controller\tool;


use app\common\controller\AdminController;

/**
 * 上传图片插件
 * Class Upload
 * @package app\admin\controller\tool
 */
class Upload extends AdminController {

    /**
     * 上传图片
     * @param string $type ['multi','one']
     * @return mixed
     */
    public function image($type = 'one') {
        return $this->fetch('', ['type' => $type]);
    }
}