<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 22:32
 */

namespace app\admin\validate\blog;


use think\Validate;

/**
 * 搜索记录验证器
 * Class SearchRecord
 * @package app\admin\validate\blog
 */
class SearchRecord extends Validate {



    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'     => 'require|number|checkId',
        'title'  => 'require|max:20',
        'remark' => 'max:250',
        'field'  => 'require',
        'value'  => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'title.require' => '名称必须',
        'title.max'     => '名称最多不能超过20个字符',
        'remark.max'    => '备注最多不能超过250个字符',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [
        //删除
        'del'        => ['id'],
    ];

    /**
     * 判断ID是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkId($value, $rule, $data = []) {
        $where = [
            ['id', '=', $value],
        ];
        $member = \app\admin\model\blog\SearchRecord::where($where)->find();
        if (empty($member)) return '信息不存在！';
        return true;
    }
}