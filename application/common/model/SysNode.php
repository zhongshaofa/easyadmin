<?php
/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\common\model;

use app\common\service\ModelService;
use app\common\service\AuthService;

class SysNode extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'system_node';

    /**
     * 自动保存节点，默认不开启
     * @param $module 模块名
     * @param $controller 模块名/控制器名
     * @param $action  模块名/控制器名/方法名
     * @param array $insertAll
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function autoSaveNode($module, $controller, $action, $insertAll = []) {

        //查找数据库中数据
        list($is_module, $is_controller, $is_action) = [$this->where('node', $module)->find(), $this->where('node', $controller)->find(), $this->where('node', $action)->find()];

        //判断是否存在
        empty($is_module) && $insertAll[] = ['node' => $module, 'type' => 1, 'is_auth' => 0];
        empty($is_controller) && $insertAll[] = ['node' => $controller, 'type' => 2, 'is_auth' => 0];
        empty($is_action) && $insertAll[] = ['node' => $action, 'type' => 3, 'is_auth' => 0];

        //存入数据库中
        !empty($insertAll) && $this->saveAll($insertAll);
    }
}