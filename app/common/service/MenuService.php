<?php


namespace app\common\service;

use think\facade\Db;

/**
 * 菜单服务类
 * Class MenuService
 * @package app\common\service
 */
class MenuService
{

    /**
     * 后台用户ID
     * @var null
     */
    protected $adminId = null;

    /**
     * 配置信息
     * @var array
     */
    protected $config = [
        'system_menu' => 'system_menu', // 菜单表
    ];

    /**
     * 构造函数
     * MenuService constructor.
     * @param $adminId
     */
    public function __construct($adminId)
    {
        $this->adminId = $adminId;
        return $this;
    }

    /**
     * 构建后台菜单信息
     * @return mixed
     */
    public function makeMenuTree()
    {
        list($menuTreeList, $data) = [[], $this->getMenuData()];
        foreach ($data as $vo) {
            if ($vo['pid'] == 0 && $vo['id'] != 1) {
                $child = $this->buildMenuChild($vo['id'], $data);
                if (!empty($child)) {
                    $vo['child'] = $child;
                    $menuTreeList['module_' . $vo['id']] = $vo;
                }
            }
        }
        return $menuTreeList;
    }

    /**
     * 构建子菜单信息
     * @param $pid
     * @param $data
     * @return array
     */
    public function buildMenuChild($pid, $data)
    {
        $menuList = [];
        foreach ($data as $vo) {
            // 权限判断
            $check = (new AuthService($this->adminId))->checkNode($vo['href']);
            if ($vo['pid'] == $pid && $check) {
                $child = $this->buildMenuChild($vo['id'], $data);
                if (!empty($child)) {
                    $vo['child'] = $child;
                }
                $menuList[] = $vo;
            }
        }
        return $menuList;
    }

    /**
     * 获取所有菜单
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMenuData()
    {
        $menuData = Db::name($this->config['system_menu'])
            ->field('id,pid,title,icon,href,target')
            ->where([
                ['status', '=', '1'],
            ])
            ->order([
                'sort' => 'asc',
                'id'   => 'asc',
            ])
            ->select();
        return $menuData;
    }

}