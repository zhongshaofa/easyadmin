<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace app\admin\traits;

use app\common\constants\SystemConstant;
use EasyAdmin\annotation\NodeAnotation;

/**
 * 后台CURD复用
 * Trait Curd
 * @package app\admin\traits
 */
trait Curd
{

    /**
     * @NodeAnotation(title="系统配置列表")
     */
    public function index()
    {

    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add()
    {

    }

    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit()
    {

    }

    /**
     * @NodeAnotation(title="删除")
     */
    public function del()
    {

    }

    /**
     * 修改字段属性值
     * @NodeAnotation(title="属性修改")
     */
    public function modify()
    {
        $post = $this->request->post();
        $rule = [
            'id|ID'    => 'require',
            'field|字段' => 'require',
            'value|值'  => 'require',
        ];
        $this->validate($post, $rule);
        $row = $this->model->find($post['id']);
        empty($row) && $this->error('数据不存在');
        !in_array($post['field'], SystemConstant::ALLOW_MODIFY_FIELD) && $this->error('该字段不允许修改：' . $post['field']);
        try {
            $row->save([
                $post['field'] => $post['value'],
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('保存成功');
    }

}