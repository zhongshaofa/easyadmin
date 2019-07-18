<?php


namespace app\admin\command;

use service\MysqlService;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class Backups extends Command
{
    protected function configure()
    {
        $this->setName('backups')
            ->setDescription('备份数据库信息');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln("......................开始备份数据库.......................");
        $data = (new MysqlService())->backups();
        $output->writeln($data['msg']);
        $output->writeln("......................结束备份数据库.......................");
    }
}