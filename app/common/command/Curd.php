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
use EasyAdmin\curd\BuildCurd;
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
            #
            ->addOption('relationTable', 'r', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联表名', null)
            ->addOption('foreignKey', 'rf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联外键', null)
            ->addOption('primaryKey', 'rp', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联主键', null)
            ->addOption('relationModelFilename', 'rmf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联模型文件名', null)
            #
            ->addOption('force', 'f', Option::VALUE_REQUIRED, '强制覆盖模式', 0)
            ->addOption('delete', 'd', Option::VALUE_REQUIRED, '删除模式', 0)
            ->setDescription('一键curd命令服务');
    }

    protected function execute(Input $input, Output $output)
    {

        $table = $input->getOption('table');
        $controllerFilename = $input->getOption('controllerFilename');

        $relationTable = $input->getOption('relationTable');
        $foreignKey = $input->getOption('foreignKey');
        $primaryKey = $input->getOption('primaryKey');
        $relationModelFilename = $input->getOption('relationModelFilename');

        $force = $input->getOption('force');
        $delete = $input->getOption('delete');

        $relations = [];
        foreach ($relationTable as $key => $val) {
            $relations[] = [
                'table'         => $relationTable[$key],
                'foreignKey'    => isset($foreignKey[$key]) ? $foreignKey[$key] : null,
                'primaryKey'    => isset($primaryKey[$key]) ? $primaryKey[$key] : null,
                'modelFilename' => isset($relationModelFilename[$key]) ? $relationModelFilename[$key] : null,
            ];
        }

        if(empty($table)){
            CliEcho::error('请设置主表');
            return false;
        }

        try {
            $build = (new BuildCurd())
                ->setTable($table)
                ->setForce($force);

            !empty($controllerFilename) && $build = $build->setControllerFilename($controllerFilename);

            foreach ($relations as $relation) {
                $build = $build->setRelation($relation['table'], $relation['foreignKey'], $relation['primaryKey'], $relation['modelFilename']);
            }

            if (!$delete) {
                $result = $build->create();
                CliEcho::success('自动生成CURD成功');
            } else {
                $result = $build->delete();
                CliEcho::success('删除自动生成CURD文件成功');
            }

        } catch (\Exception $e) {
            CliEcho::error($e->getMessage());
        }
        var_dump($result);
    }


}