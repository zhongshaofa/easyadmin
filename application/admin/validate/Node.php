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

namespace app\admin\validate;


use think\Validate;

class Node extends Validate {
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'    => 'require|number|checkNodeId',
        'field' => 'require',
        'value' => 'require|max:30',
        'node'  => 'require|checkNode',
        'title' => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'node.require'  => '系统节点必须',
        'id.number'     => '编号为数字',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
        'value.max'     => '修改值最多不能超过30个字符',
        'title.max'     => '修改值最多不能超过30个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //添加系统节点
        'add'        => ['node', 'title'],

        //修改系统节点字段值
        'edit_field' => ['id', 'field', 'value'],

        //删除节点
        'del'        => ['id'],

        //更改节点状态
        'status'     => ['id'],
    ];

    /**
     * 自定义验证场景
     * @return Node
     */
    public function sceneEdit()
    {
        return $this->only(['id','node','title'])
            ->remove('node', 'checkNode');
    }

    /**
     * 检测节点id是否存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkNodeId($value, $rule, $data = []) {
        $user = \app\admin\model\node::where(['id' => $value])->find();
        if (empty($user)) return '暂无节点数据，请稍后再试！';
        return true;
    }

    /**
     * 检测系统节点是否存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkNode($value, $rule, $data = []) {
        $user = \app\admin\model\node::where(['node' => $value])->find();
        if (!empty($user)) return '已存在该系统节点，无需再次添加！';
        return true;
    }
}