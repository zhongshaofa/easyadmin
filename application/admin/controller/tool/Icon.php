<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15
 * Time: 21:51
 */

namespace app\admin\controller\tool;


use app\common\controller\AdminController;

/**
 * 图标管理
 * Class Icon
 * @package app\admin\controller
 */
class Icon extends AdminController {

    /**
     * 图标列表
     */
    public function index() {

        $basic_data = [
            'title' => '图标列表',
        ];
        return $this->fetch('', $basic_data);
    }

    public function fa(){
        $basic_data = [
            'title' => 'fa图标列表',
        ];
        return $this->fetch('', $basic_data);
    }
}