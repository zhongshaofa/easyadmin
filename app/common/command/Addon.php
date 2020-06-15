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
use EasyAdmin\console\CliEcho;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use EasyAdmin\auth\Node as NodeService;

class Addon extends Command
{
    protected function configure()
    {
        $this->setName('addon')
            ->setDescription('插件安装服务');
    }

    protected function execute(Input $input, Output $output)
    {
        CliEcho::success('正在执行插件安装服务');
    }


}