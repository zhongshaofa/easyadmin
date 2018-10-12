<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 23:09
 */

namespace app\admin\validate\blog;


use think\Validate;

/**
 * 公告验证器
 * Class Notice
 * @package app\admin\validate\blog
 */
class Notice extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'     => 'require|number|checkId',
        'title'  => 'require|max:250',
        'href'   => 'require|max:250',
        'remark' => 'max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'title.require' => '公告标题必须',
        'title.max'     => '公告标题最多不能超过250个字符',
        'href.require'  => '链接地址必须',
        'href.max'      => '链接地址最多不能超过250个字符',
        'remark.max'    => '备注最多不能超过250个字符',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [
        //添加
        'add'    => ['title', 'href', 'remark'],

        //编辑
        'edit'   => ['id', 'title', 'href', 'remark'],

        //删除
        'del'    => ['id'],

        //更改状态
        'status' => ['id'],
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
        $member = \app\admin\model\blog\Notice::where($where)->find();
        if (empty($member)) return '信息不存在！';
        return true;
    }
}