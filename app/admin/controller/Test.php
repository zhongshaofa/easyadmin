<?php


namespace app\admin\controller;


use service\MysqlService;
use think\facade\App;
use think\facade\Db;

class Test
{
    public function back()
    {
        $data = (new MysqlService())->backups();
        dump($data);
    }
}