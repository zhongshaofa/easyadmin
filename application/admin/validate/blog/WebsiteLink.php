<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 23:10
 */

namespace app\admin\validate\blog;


use think\Validate;

/**
 * 友情链接验证器
 * Class WebsiteLink
 * @package app\admin\validate\blog
 */
class WebsiteLink extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'           => 'require|number|checkId',
        'website_name' => 'require|max:20',
        'href'         => 'require|max:250',
        'remark'       => 'max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'           => '编号必须',
        'website_name.require' => '站点名称必须',
        'website_name.max'     => '站点名称最多不能超过20个字符',
        'href.require'         => '链接地址必须',
        'href.max'             => '链接地址最多不能超过250个字符',
        'remark.max'           => '备注最多不能超过250个字符',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [
        //添加
        'add'    => ['website_name', 'href', 'remark'],

        //编辑
        'edit'   => ['id', 'website_name', 'href', 'remark'],

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
        $member = \app\admin\model\blog\WebsiteLink::where($where)->find();
        if (empty($member)) return '信息不存在！';
        return true;
    }
}