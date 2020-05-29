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
            ->addOption('modelFilename', 'm', Option::VALUE_REQUIRED, '主表模型文件名', null)
            #
            ->addOption('checkboxFieldSuffix', 'chfs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '复选框字段后缀', null)
            ->addOption('radioFieldSuffix', 'rafs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '单选框字段后缀', null)
            ->addOption('imageFieldSuffix', 'imfs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '单图片字段后缀', null)
            ->addOption('imagesFieldSuffix', 'imsfs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '多图片字段后缀', null)
            ->addOption('fileFieldSuffix', 'fifs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '单文件字段后缀', null)
            ->addOption('filesFieldSuffix', 'fisfs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '多文件字段后缀', null)
            ->addOption('dateFieldSuffix', 'dafs', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '时间字段后缀', null)
            ->addOption('switchFields', 'swf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '开关的字段', null)
            ->addOption('selectFileds', 'sef', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '下拉的字段', null)
            ->addOption('editorFields', 'edf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '富文本的字段', null)
            ->addOption('sortFields', 'sof', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '排序的字段', null)
            ->addOption('ignoreFields', 'igf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '忽略的字段', null)
            #
            ->addOption('relationTable', 'r', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联表名', null)
            ->addOption('foreignKey', 'fkey', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联外键', null)
            ->addOption('primaryKey', 'pkey', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联主键', null)
            ->addOption('relationModelFilename', 'remf', Option::VALUE_REQUIRED | Option::VALUE_IS_ARRAY, '关联模型文件名', null)
            #
            ->addOption('force', 'f', Option::VALUE_REQUIRED, '强制覆盖模式', 0)
            ->addOption('delete', 'd', Option::VALUE_REQUIRED, '删除模式', 0)
            ->setDescription('一键curd命令服务');
    }

    protected function execute(Input $input, Output $output)
    {

        $table = $input->getOption('table');
        $controllerFilename = $input->getOption('controllerFilename');
        $modelFilename = $input->getOption('modelFilename');

        $checkboxFieldSuffix = $input->getOption('checkboxFieldSuffix');
        $radioFieldSuffix = $input->getOption('radioFieldSuffix');
        $imageFieldSuffix = $input->getOption('imageFieldSuffix');
        $imagesFieldSuffix = $input->getOption('imagesFieldSuffix');
        $fileFieldSuffix = $input->getOption('fileFieldSuffix');
        $filesFieldSuffix = $input->getOption('filesFieldSuffix');
        $dateFieldSuffix = $input->getOption('dateFieldSuffix');
        $switchFields = $input->getOption('switchFields');
        $selectFileds = $input->getOption('selectFileds');
        $sortFields = $input->getOption('sortFields');
        $ignoreFields = $input->getOption('ignoreFields');

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

        if (empty($table)) {
            CliEcho::error('请设置主表');
            return false;
        }

        try {
            $build = (new BuildCurd())
                ->setTable($table)
                ->setForce($force);

            !empty($controllerFilename) && $build = $build->setControllerFilename($controllerFilename);
            !empty($modelFilename) && $build = $build->setModelFilename($modelFilename);

            !empty($checkboxFieldSuffix) && $build = $build->setCheckboxFieldSuffix($checkboxFieldSuffix);
            !empty($radioFieldSuffix) && $build = $build->setRadioFieldSuffix($radioFieldSuffix);
            !empty($imageFieldSuffix) && $build = $build->setImageFieldSuffix($imageFieldSuffix);
            !empty($imagesFieldSuffix) && $build = $build->setImagesFieldSuffix($imagesFieldSuffix);
            !empty($fileFieldSuffix) && $build = $build->setFileFieldSuffix($fileFieldSuffix);
            !empty($filesFieldSuffix) && $build = $build->setFilesFieldSuffix($filesFieldSuffix);
            !empty($dateFieldSuffix) && $build = $build->setDateFieldSuffix($dateFieldSuffix);
            !empty($switchFields) && $build = $build->setSwitchFields($switchFields);
            !empty($selectFileds) && $build = $build->setSelectFileds($selectFileds);
            !empty($sortFields) && $build = $build->setSortFields($sortFields);
            !empty($ignoreFields) && $build = $build->setIgnoreFields($ignoreFields);

            foreach ($relations as $relation) {
                $build = $build->setRelation($relation['table'], $relation['foreignKey'], $relation['primaryKey'], $relation['modelFilename']);
            }

            $build = $build->render();

            if (!$delete) {
                $result = $build->create();
                CliEcho::success('自动生成CURD成功');
            } else {
                $result = $build->delete();
                CliEcho::success('删除自动生成CURD文件成功');
            }

            CliEcho::success('>>>>>>>>>>>>>>>');
            foreach ($result as $vo) {
                CliEcho::success($vo);
            }

        } catch (\Exception $e) {
            CliEcho::error($e->getMessage());
            return false;
        }
    }


}