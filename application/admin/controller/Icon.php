<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller;


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
}