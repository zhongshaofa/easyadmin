<?php


namespace app\admin\controller\system;


use app\common\controller\AdBaseController;

class Menu extends AdBaseController
{
    public function index()
    {
        if ($this->request->get('type') == 'ajax') {
            $data = [
                'code'  => 0,
                'msg'   => '获取成功',
                'count' => 19,
                'data'  => [
                    [
                        'authorityId'   => 1,
                        'authorityName' => '系统管理',
                        'orderNumber'   => 1,
                        'menuUrl'       => null,
                        'menuIcon'      => 'layui-icon-set',
                        'createTime'    => '2018/06/29 11:05:41',
                        'authority'     => null,
                        'checked'       => 0,
                        'updateTime'    => '2018/07/13 09:13:42',
                        'isMenu'        => 0,
                        'parentId'      => -1,
                    ],
                ],
            ];
            return json($data);
        }
        return view();
    }
}