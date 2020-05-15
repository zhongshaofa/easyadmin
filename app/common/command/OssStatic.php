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


use EasyAdmin\console\CliEcho;
use EasyAdmin\tool\CommonTool;
use EasyAdmin\upload\driver\alioss\Oss;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

class OssStatic extends Command
{

    protected function configure()
    {
        $this->setName('OssStatic')
            ->setDescription('将静态资源上传到oss上');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln("========正在上传静态资源到OSS上：========" . date('Y-m-d H:i:s'));
        $dir = root_path() . 'public' . DIRECTORY_SEPARATOR . 'static';
        $list = CommonTool::readDirAllFiles($dir);
        $uploadConfig = sysconfig('upload');
        $uploadPrefix = config('app.oss_static_prefix', 'oss_static_prefix');
        foreach ($list as $key => $val) {
            list($objectName, $filePath) = [$uploadPrefix . DIRECTORY_SEPARATOR . $key, $val];
            try {
                $upload = Oss::instance($uploadConfig)
                    ->save($objectName, $filePath);
            } catch (\Exception $e) {
                CliEcho::error('文件上传失败：' . $filePath . '。错误信息：' . $e->getMessage());
                continue;
            }
            if ($upload['save'] == true) {
                CliEcho::success('文件上传成功：' . $filePath . '。上传地址：' . $upload['url']);
            } else {
                CliEcho::error('文件上传失败：' . $filePath . '。错误信息：' . $upload['msg']);
            }
        }
        $output->writeln("========已完成静态资源上传到OSS上：========" . date('Y-m-d H:i:s'));
    }

}