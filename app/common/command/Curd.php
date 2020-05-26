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

namespace app\common\command;


use app\admin\model\SystemNode;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use EasyAdmin\auth\Node as NodeService;

class Curd extends Command
{
    protected function configure()
    {
        $this->setName('curd')
            ->addOption('table', 't', Option::VALUE_REQUIRED, '主表名', null)
            ->addOption('controllerFilename', 'c', Option::VALUE_REQUIRED, '控制器文件名', null)

            ->addOption('relationTable', 'r', Option::VALUE_REQUIRED, '关联表名', null)
            ->addOption('foreignKey', 'rf', Option::VALUE_REQUIRED, '关联外键', null)
            ->addOption('primaryKey', 'rp', Option::VALUE_REQUIRED, '关联主键', null)
            ->addOption('relationModelFilename', 'rmf', Option::VALUE_REQUIRED, '关联模型文件名', null)

            ->addOption('force', 'f', Option::VALUE_REQUIRED, '强制覆盖模式', 0)
            ->addOption('delete', 'd', Option::VALUE_REQUIRED, '删除模式', 0)
            ->setDescription('一键curd命令服务');
    }

    protected function execute(Input $input, Output $output)
    {

    }


}