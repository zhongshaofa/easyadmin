<?php


namespace service;


use think\facade\App;
use think\facade\Db;

class MysqlService
{

    /**
     * 备份数据库
     */
    public function backups()
    {
        $backupFilenName = App::getRootPath() . "/install/sql/install_".date("YmdHis", time()).".sql";
        $tables = Db::query('SHOW TABLES ');
        $tableList = [];
        foreach ($tables as $v) {
            foreach ($v as $vv) {
                $tableList[] = $vv;
            }
        }

        $info = "-- ----------------------------\r\n";
        $info .= "-- 备份日期：" . date("Y-m-d H:i:s", time()) . "\r\n";
        $info .= "-- ----------------------------\r\n\r\n";

        file_put_contents($backupFilenName, $info, FILE_APPEND);
        foreach ($tableList as $val) {
            $res = Db::query('show create table ' . $val);
            foreach ($res as $v) {
                $newres = $v['Create Table'];
            }

            $info = "-- ----------------------------\r\n";
            $info .= "-- Table structure for `" . $val . "`\r\n";
            $info .= "-- ----------------------------\r\n";

            $info .= "DROP TABLE IF EXISTS `" . $val . "`;\r\n";
            $sqlStr = $info . $newres . ";\r\n\r\n";
            file_put_contents($backupFilenName, $sqlStr, FILE_APPEND);
        }

        foreach ($tableList as $val) {
            $res = Db::query('select * from ' . $val);
            if (count($res) < 1) continue;

            $info = "-- ----------------------------\r\n";
            $info .= "-- Records for `" . $val . "`\r\n";
            $info .= "-- ----------------------------\r\n";

            file_put_contents($backupFilenName, $info, FILE_APPEND);
            foreach ($res as $v) {
                $sqlstr = "INSERT INTO `" . $val . "` VALUES (";
                foreach ($v as $vv) {
                    //将数据中的单引号转义，否则还原时会出错
                    $newvv = str_replace("'", "\'", $vv);
                    $sqlstr .= "'" . $newvv . "', ";
                }
                //去掉最后一个逗号和空格
                $sqlstr = substr($sqlstr, 0, strlen($sqlstr) - 2);
                $sqlstr .= ");\r\n";
                file_put_contents($backupFilenName, $sqlstr, FILE_APPEND);
            }
            file_put_contents($backupFilenName, "\r\n", FILE_APPEND);
        }
        return ['code' => 1, 'msg' => '完成备份'];
    }
}