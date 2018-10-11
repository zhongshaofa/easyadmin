<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 2:59
 */

namespace app\admin\validate;


use think\Validate;

/**
 * 公共验证规则
 * Class Common
 * @package app\admin\validate
 */
class Common extends Validate {
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'    => 'require|number',
        'field' => 'require',
        'value' => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [
        //修改字段值
        'edit_field' => ['id', 'field', 'value'],
    ];
}