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

namespace app\admin\service;


use think\facade\Db;
use think\facade\Config;

/**
 * 系统日志表
 * Class SystemLogService
 * @package app\admin\service
 */
class SystemLogService
{

    /**
     * 当前实例
     * @var object
     */
    protected static $instance;

    /**
     * 表前缀
     * @var string
     */
    protected $tablePrefix;

    /**
     * 表后缀
     * @var string
     */
    protected $tableSuffix;

    /**
     * 表名
     * @var string
     */
    protected $tableName;

    /**
     * 构造方法
     * SystemLogService constructor.
     */
    protected function __construct()
    {
        $this->tablePrefix = Config::get('database.connections.mysql.prefix');
        $this->tableSuffix = date('Ym', time());
        $this->tableName = "{$this->tablePrefix}system_log_{$this->tableSuffix}";
        return $this;
    }

    /**
     * 获取实例对象
     * @return SystemLogService|object
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }


    /**
     * 保存数据
     * @param $data
     * @return bool|string
     */
    public function save($data)
    {
        $this->detectTable();
        Db::startTrans();
        try {
            Db::table($this->tableName)->insert($data);
            Db::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }

    /**
     * 检测数据表
     * @return bool
     */
    protected function detectTable()
    {
        $check = Db::query("show tables like '{$this->tableName}'");
        if (empty($check)) {
            $sql = $this->getCreateSql();
            Db::execute($sql);
        }
        return true;
    }

    public function getAllTableList()
    {

    }

    /**
     * 根据后缀获取创建表的sql
     * @return string
     */
    protected function getCreateSql()
    {
        return <<<EOT
CREATE TABLE `{$this->tableName}` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) unsigned DEFAULT '0' COMMENT '管理员ID',
  `url` varchar(1500) NOT NULL DEFAULT '' COMMENT '操作页面',
  `method` varchar(50) NOT NULL COMMENT '请求方法',
  `title` varchar(100) DEFAULT '' COMMENT '日志标题',
  `content` text NOT NULL COMMENT '内容',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
  `useragent` varchar(255) DEFAULT '' COMMENT 'User-Agent',
  `create_time` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=630 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='后台操作日志表 - {$this->tableSuffix}';
EOT;
    }

}