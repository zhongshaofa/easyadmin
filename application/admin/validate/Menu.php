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

/**
 * 菜单管理验证类
 * Class Menu
 * @package app\admin\validate
 */
class Menu extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'     => 'require|number|checkId',
        'pid'    => 'require|number',
        'title'  => 'require|max:10',
        'href'   => 'max:100',
        'icon'   => 'max:20',
        'sort'   => 'max:10|number',
        'status' => 'require|in:0,1',
        'remark' => 'max:250',
        'field' => 'require',
        'value' => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'pid.require'   => '上级菜单必须',
        'pid.number'    => '上级菜单数据有误',
        'title.require' => '菜单名称必须',
        'title.max'     => '名称最多不能超过10个字符',
        'href.max'      => '链接最多不能超过100个字符',
        'status.in'     => '启用状态格式有误',
        'sort.number'   => '排序必须为数字',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //添加菜单
        'add'  => ['pid', 'title', 'href', 'icon', 'sort', 'remark'],

        //修改菜单
        'edit' => ['id', 'pid', 'title', 'href', 'icon', 'sort', 'remark'],

        //删除菜单
        'del'  => ['id'],

        //更改菜单状态
        'status'  => ['id'],

        //修改字段值
        'edit_field' => ['id', 'field', 'value'],
    ];

    /**
     * 检测菜单是否存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkId($value, $rule, $data = []) {
        $menu = \app\admin\model\menu::where(['id' => $value])->find();
        if (empty($menu)) return '暂无菜单数据，请稍后再试！';
        return true;
    }
}