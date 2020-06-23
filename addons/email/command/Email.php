<?php


namespace addons\email\command;


use EasyAdmin\console\CliEcho;
use think\console\Command;
use think\console\Input;
use think\console\Output;


class Email extends Command
{
    protected function configure()
    {
        $this->setName('email')
            ->setDescription('插件邮件服务');
    }

    protected function execute(Input $input, Output $output)
    {
        CliEcho::success('正在发送插件邮件');
    }


}