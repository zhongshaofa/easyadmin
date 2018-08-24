<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\admin\controller\api;


use app\common\controller\AdminController;

class Node extends AdminController {

    /**
     * 获取对应角色的节点数据
     * @param $id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNodeTree($id) {
        $list = [];
        $module = model('node')->where(['type' => 1, 'is_auth' => 1])->select();
        foreach ($module as $k => $val) {
            $list[$k] = [
                'title' => $this->__biuldGetNodeTree($val['node'], $val['title']),
                'value' => $val['id'],
                'data'  => [],
            ];
            $is_checked = model('auth_node')->where(['auth' => $id, 'node' => $val['id']])->find();
            !empty($is_checked) && $list[$k]['checked'] = true;
            $data_1 = model('node')->where([['type', '=', 2], ['is_auth', '=', 1], ['node', 'LIKE', $val['node'] . '%']])->select();
            foreach ($data_1 as $k_1 => $val_1) {
                $list[$k]['data'][$k_1] = [
                    'title' => $this->__biuldGetNodeTree($val_1['node'], $val_1['title']),
                    'value' => $val_1['id'],
                    'data'  => [],
                ];
                $is_checked_1 = model('auth_node')->where(['auth' => $id, 'node' => $val_1['id']])->find();
                !empty($is_checked_1) && $list[$k]['data'][$k_1]['checked'] = true;
                $data_2 = model('node')->where([['type', '=', 3], ['is_auth', '=', 1], ['node', 'LIKE', $val_1['node'] . '%']])->select();
                foreach ($data_2 as $k_2 => $val_2) {
                    $list[$k]['data'][$k_1]['data'][$k_2] = [
                        'title' => $this->__biuldGetNodeTree($val_2['node'], $val_2['title']),
                        'value' => $val_2['id'],
                        'data'  => [],
                    ];
                    $is_checked_2 = model('auth_node')->where(['auth' => $id, 'node' => $val_2['id']])->find();
                    !empty($is_checked_2) && $list[$k]['data'][$k_1]['data'][$k_2]['checked'] = true;
                }
            }
        }
        return json($list);
    }

    /**
     * 组合数据
     * @param $node
     * @param $title
     * @return string
     */
    protected function __biuldGetNodeTree($node, $title) {
        if (empty($title)) return $node;
        else return $title . '【' . $node . '】';
    }
}