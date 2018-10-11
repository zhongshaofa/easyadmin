<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 0:52
 */

namespace app\admin\validate\blog;

use think\Validate;

/**
 * 文章标签验证器
 * Class Tag
 * @package app\admin\validate\blog
 */
class Tag extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'        => 'require|number|checkId',
        'tag_title' => 'require|max:20|checkTagTitle',
        'remark'    => 'max:250',
        'field'     => 'require',
        'value'     => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'        => '编号必须',
        'tag_title.require' => '名称必须',
        'tag_title.max'     => '名称最多不能超过20个字符',
        'remark.max'        => '备注最多不能超过250个字符',
        'field.require'     => '字段必须',
        'value.require'     => '修改值必须',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [
        //添加
        'add'        => ['tag_title', 'remark'],

        //编辑
        'edit'       => ['id', 'tag_title', 'remark'],

        //删除
        'del'        => ['id'],

        //更改状态
        'status'     => ['id'],

        //修改字段值
        'edit_field' => ['id', 'field', 'value'],
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
        $member = \app\admin\model\blog\Tag::where($where)->find();
        if (empty($member)) return '标签不存在！';
        return true;
    }

    /**
     * 检查标签名是否重复
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkTagTitle($value, $rule, $data = []) {
        $where = [
            ['tag_title', '=', $value],
        ];

        //编辑，需要排除自身条件
        isset($data['id']) && $where[] = ['id', 'NotIn', [$data['id']]];

        $member = \app\admin\model\blog\Tag::where($where)->find();
        if (!empty($member)) return '已存在该标签名，请更换重试！';
        return true;
    }
}