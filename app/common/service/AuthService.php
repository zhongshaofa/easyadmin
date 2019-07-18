<?php


namespace app\common\service;

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
     * 判断节点权限
     * @param $node
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function checkNode($node)
    {
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
        if (empty($nodeInfo) || $nodeInfo['is_auth'] == 0) {
            return true;
        }

        // 用户验证，优先获取缓存信息
        $adminInfo = Db::name($this->config['system_admin'])
            ->where('id', $this->adminId)
            ->find();
        if (empty($adminInfo)) {
            return false;
        } elseif ($adminInfo['status'] != 1) {
            return false;
        } elseif ($adminInfo['is_super'] == 1) {
            return true;
        } elseif (empty($adminInfo['auth_ids'])) {
            return false;
        }

        // 判断该节点是否允许访问
        $allNode =$this->getAdminNode();
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
        $node = request()->app() . '/' . request()->controller() . '/' . request()->action();
        return $this->parseNodeStr($node);
    }

    /**
     * 获取用户的授权节点
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAdminNode()
    {
        $nodeList = [];
        $adminInfo = Db::name($this->config['system_admin'])
            ->where([
                'id'     => $this->adminId,
                'status' => 1,
            ])->find();
        if (!empty($userInfo)) {
            $authIdArr = explode(',', $adminInfo['auth_ids']);
            $buildAuthSql = Db::name($this->config['system_auth'])
                ->where("id IN {$authIdArr}")
                ->distinct(true)
                ->field('id')
                ->buildSql(true);
            $buildAuthNodeSql = Db::name($this->config['system_auth_node'])
                ->where("auth_id IN {$buildAuthSql}")
                ->distinct(true)
                ->field('node_id')
                ->buildSql(true);
            $nodeList = Db::name($this->config['system_auth_node'])
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
        $tmp = [];
        foreach (explode('/', $node) as $name) {
            $tmp[] = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
        return str_replace('._', '.', trim(join('/', $tmp), '/'));
    }
}