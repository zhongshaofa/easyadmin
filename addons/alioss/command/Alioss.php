<?php

namespace addons\alioss\command;

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

class Alioss extends Command
{
    protected function configure()
    {
        $this->setName('alioss')
            ->setDescription('alioss服务插件');
    }

    protected function execute(Input $input, Output $output)
    {
        echo '========alioss=========';
    }

}