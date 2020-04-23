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

namespace app\common\service;

use app\common\constants\AdminConstant;
use EasyAdmin\tool\CommonTool;
use think\facade\Db;

/**
 * 权限验证服务
 * Class AuthService
 * @package app\common\service
 */
class AuthService
{

    /**
     * 用户ID
     * @var null
     */
    protected $adminId = null;

    /**
     * 默认配置
     * @var array
     */
    protected $config = [
        'auth_on'          => true,              // 权限开关
        'system_admin'     => 'system_admin',    // 用户表
        'system_auth'      => 'system_auth',     // 权限表
        'system_node'      => 'system_node',     // 节点表
        'system_auth_node' => 'system_auth_node',// 权限-节点表
    ];

    /***
     * 构造方法
     * AuthService constructor.
     * @param null $adminId
     */
    public function __construct($adminId = null)
    {
        $this->adminId = $adminId;
        return $this;
    }

    /**
     * 检测检测权限
     * @param null $node
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function checkNode($node = null)
    {
        // 判断是否为超级管理员
        if ($this->adminId == AdminConstant::SUPER_ADMIN_ID) {
            return true;
        }
        // 判断权限验证开关
        if ($this->config['auth_on'] == false) {
            return true;
        }
        // 判断是否需要获取当前节点
        if (empty($node)) {
            $node = $this->getCurrentNode();
        } else {
            $node = $this->parseNodeStr($node);
        }
        // 判断是否加入节点控制，优先获取缓存信息
        $nodeInfo = Db::name($this->config['system_node'])
            ->where(['node' => $node])
            ->find();
        if (empty($nodeInfo)) {
            return false;
        }
        if ($nodeInfo['is_auth'] == 0) {
            return true;
        }
        // 用户验证，优先获取缓存信息
        $adminInfo = Db::name($this->config['system_admin'])
            ->where('id', $this->adminId)
            ->find();
        if (empty($adminInfo) || $adminInfo['status'] != 1 || empty($adminInfo['auth_ids'])) {
            return false;
        }
        // 判断该节点是否允许访问
        $allNode = $this->getAdminNode();
        if (in_array($node, $allNode)) {
            return true;
        }
        return false;
    }

    /**
     * 获取当前节点
     * @return string
     */
    public function getCurrentNode()
    {
        $node = $this->parseNodeStr(request()->controller() . '/' . request()->action());
        return $node;
    }

    /**
     * 获取当前管理员所有节点
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminNode()
    {
        $nodeList = [];
        $adminInfo = Db::name($this->config['system_admin'])
            ->where([
                'id'     => $this->adminId,
                'status' => 1,
            ])->find();
        if (!empty($adminInfo)) {
            $buildAuthSql = Db::name($this->config['system_auth'])
                ->distinct(true)
                ->whereIn('id', $adminInfo['auth_ids'])
                ->field('id')
                ->buildSql(true);
            $buildAuthNodeSql = Db::name($this->config['system_auth_node'])
                ->distinct(true)
                ->where("auth_id IN {$buildAuthSql}")
                ->field('node_id')
                ->buildSql(true);
            $nodeList = Db::name($this->config['system_node'])
                ->distinct(true)
                ->where("id IN {$buildAuthNodeSql}")
                ->column('node');
        }
        return $nodeList;
    }

    /**
     * 驼峰转下划线规则
     * @param string $node
     * @return string
     */
    public function parseNodeStr($node)
    {
        $array = explode('/', $node);
        foreach ($array as $key => $val) {
            if ($key == 0) {
                $val = explode('.', $val);
                foreach ($val as &$vo) {
                    $vo = CommonTool::humpToLine(lcfirst($vo));
                }
                $val = implode('.', $val);
                $array[$key] = $val;
            }
        }
        $node = implode('/', $array);
        return $node;
    }

}