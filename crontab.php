<?php

use utils\service\CrontabService;

require_once "vendor/autoload.php";

date_default_timezone_set('PRC');

$dbConfig = [
    'hostname' => '127.0.0.1',
    'hostport' => '3306',
    'username' => 'root',
    'password' => 'root',
    'database' => 'test',
    'charset' => 'utf8mb4'
];

if (file_exists('.env')) {
    $dbConfig = array_merge($dbConfig, array_change_key_case(parse_ini_file('.env')));
}

echo PHP_EOL . "\033[32;40m============================ [" . date("Y-m-d H:i:s") . " 启动系统任务] ============================\033[0m" . PHP_EOL . PHP_EOL;
$systemCrontabServiceObj = new CrontabService();
$systemCrontabServiceObj->setDebug(true)
    ->setName('System Crontab')
    ->setDbConfig($dbConfig)
    ->run();