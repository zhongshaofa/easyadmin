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
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use EasyAdmin\auth\Node as NodeService;

class Node extends Command
{
    protected function configure()
    {
        $this->setName('node')
            ->addOption('force', null, Option::VALUE_REQUIRED, '是否强制刷新', 0)
            ->setDescription('系统节点刷新服务');
    }

    protected function execute(Input $input, Output $output)
    {
        $force = $input->getOption('force');
        $output->writeln("========正在刷新节点服务：=====" . date('Y-m-d H:i:s'));
        $check = $this->refresh($force);
        $check !== true && $output->writeln("节点刷新失败：" . $check);
        $output->writeln("刷新完成：" . date('Y-m-d H:i:s'));
    }

    protected function refresh($force)
    {
        $nodeList = (new NodeService())->getNodelist();
        if (empty($nodeList)) {
            return true;
        }
        $model = new SystemNode();
        try {
            if ($force == 1) {
                $updateNodeList = $model->whereIn('node', array_column($nodeList, 'node'))->select();
                $formatNodeList = array_format_key($nodeList, 'node');
                foreach ($updateNodeList as $vo) {
                    isset($formatNodeList[$vo['node']]) && $model->where('id', $vo['id'])->update([
                        'title'   => $formatNodeList[$vo['node']]['title'],
                        'is_auth' => $formatNodeList[$vo['node']]['is_auth'],
                    ]);
                }
            }
            $existNodeList = $model->field('node,title,type,is_auth')->select();
            foreach ($nodeList as $key => $vo) {
                foreach ($existNodeList as $v) {
                    if ($vo['node'] == $v->node) {
                        unset($nodeList[$key]);
                        break;
                    }
                }
            }
            $model->insertAll($nodeList);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }

}