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

namespace app\admin\command;


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
        $output->writeln("========正在刷新节点服务：=====".date('Y-m-d H:i:s'));
        $this->refresh($force);
        $output->writeln("刷新完成：".date('Y-m-d H:i:s'));
    }

    protected function refresh($force)
    {
        $nodeList = (new NodeService())->getNodelist();
        if (empty($nodeList)) {
            return true;
        }
        $model = new SystemNode();
        if ($force == 1) {
            $model->whereIn('node', array_column($nodeList, 'node'))->delete();
        } else {
            $existNodeList = $model->field('node,title,type,is_auth')->select();
            foreach ($nodeList as $key => $vo) {
                foreach ($existNodeList as $v) {
                    if ($vo['node'] == $v->node) {
                        unset($nodeList[$key]);
                        break;
                    }
                }
            }
        }
        $model->insertAll($nodeList);
        return true;
    }

}