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

namespace EasyAdmin\upload\driver;

use EasyAdmin\upload\Base;
use EasyAdmin\upload\driver\alioss\Oss;

class Alioss extends Base
{

    public function save()
    {
        parent::save();
        $upload = Oss::instance()
            ->setConfig($this->uploadConfig)
            ->save($this->completeFilePath);
        $this->rmLocalSave();
        return $upload;
    }

}