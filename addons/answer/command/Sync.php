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

namespace addons\answer\command;

use EasyAdmin\console\CliEcho;
use think\console\Command;
use think\console\Input;
use think\console\Output;


class Sync extends Command
{
    protected function configure()
    {
        $this->setName('answer:sync')
            ->setDescription('问答社区同步服务');
    }

    protected function execute(Input $input, Output $output)
    {
        CliEcho::success('正在同步 -- 问答社区 --');
    }


}