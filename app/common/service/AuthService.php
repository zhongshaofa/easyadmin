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

    /**
     * 管理员信息
     * @var array|\think\Model|null
     */
    protected $adminInfo;

    /**
     * 所有节点信息
     * @var array
     */
    protected $nodeList;

    /**
     * 管理员所有授权节点
     * @var array
     */
    protected $adminNode;

    /***
     * 构造方法
     * AuthService constructor.
     * @param null $adminId
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function __construct($adminId = null)
    {
        $this->adminId = $adminId;
        $this->adminInfo = $this->getAdminInfo();
        $this->nodeList = $this->getNodeList();
        $this->adminNode  = $this->getAdminNode();
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
        if (!isset($this->nodeList[$node])) {
            return false;
        }
        $nodeInfo = $this->nodeList[$node];
        if ($nodeInfo['is_auth'] == 0) {
            return true;
        }
        // 用户验证，优先获取缓存信息
        if (empty($this->adminInfo) || $this->adminInfo['status'] != 1 || empty($this->adminInfo['auth_ids'])) {
            return false;
        }
        // 判断该节点是否允许访问
        if (in_array($node, $this->adminNode)) {
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
        if (!empty($adminInfo) && !empty($adminInfo['auth_ids'])) {
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
     * 获取所有节点信息
     * @time 2021-01-07
     * @return array
     * @author zhongshaofa <shaofa.zhong@happy-seed.com>
     */
    public function getNodeList(){
        return  Db::name($this->config['system_node'])
            ->column('id,node,title,type,is_auth','node');
    }

    /**
     * 获取管理员信息
     * @time 2021-01-07
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author zhongshaofa <shaofa.zhong@happy-seed.com>
     */
    public function getAdminInfo(){
        return  Db::name($this->config['system_admin'])
            ->where('id', $this->adminId)
            ->find();
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