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
 * 系统参数验证
 * Class Config
 * @package app\admin\validate
 */
class Config extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'      => 'require|number|checkConfigId',
        'field'   => 'require',
        'value'   => 'require|max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
        'value.max'     => '修改值最多不能超过250个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //修改字段值
        'edit_field' => ['id', 'field', 'value'],
    ];

    /**
     * 检测ID是否存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkConfigId($value, $rule, $data = []) {
        $config = \app\admin\model\Config::where(['id' => $value])->find();
        if (empty($config)) return '暂无数据，请稍后再试！';
        return true;
    }
}