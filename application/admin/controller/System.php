<?php
/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminController;
use app\common\model\SysNode;
use app\common\service\NodeService;
use think\facade\Cache;

/**
 * 系统服务
 * Class System
 * @package app\admin\controller
 */
class System extends AdminController {

    /**
     * 刷新缓存
     */
    public function refresh() {
        if (app('cache')->clear()) {
            echo '缓存刷新成功';
            return msg_success('缓存刷新成功！');
        } else {
            echo '缓存刷新失败';
            return msg_error('缓存刷新失败！');
        }
    }

    /**
     * 刷新节点
     */
    public function refresh_node() {
        if (!$this->request->isPost()) {
            //get ajax 访问
            if ($this->request->get('type') == 'ajax') {
                $node_list = NodeService::refreshNode();
                if (!empty($node_list)) return __success('节点刷新成功！');
                return __error('暂无数据变化');
            }
            $modules = NodeService::getFolders(env('app_path'));
            $module_list = [];
            foreach ($modules as $k => $val) {
                $node = model('node')->where(['node' => $val, 'type' => 1])->find();
                !empty($node) ? $module_list[$k] = ['module' => $val, 'title' => $node['title']] : $module_list[$k] = ['module' => $val, 'title' => ''];
                $val == 'admin' ? $module_list[$k]['is_checked'] = true : $module_list[$k]['is_checked'] = false;
            }
            $basic_data = [
                'title'       => '系统节点列表',
                'module_list' => $module_list,
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();
            if (empty($post['module'])) return __error('请选中需要刷新节点的模块！');
            $node_list = NodeService::refreshNode($post['module']);
            if ($node_list['code'] == 0) {
                //清空菜单缓存
                clear_menu();
                return __success($node_list['msg']);
            } else {
                return __error($node_list['msg']);
            }
        }
    }

    /**
     * 清除失效节点
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function clear_node() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'title' => '清除失效节点',
            ];
            return $this->fetch('', $basic_data);
        } else {
            $clean = NodeService::cleanNode();
            if ($clean['code'] == 0) {
                return __success($clean['msg']);
            } else {
                return __error($clean['msg']);
            }
        }

    }
}