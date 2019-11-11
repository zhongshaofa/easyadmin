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

namespace EasyAdmin\upload;

use EasyAdmin\upload\driver\Alioss;
use EasyAdmin\upload\driver\Local;
use EasyAdmin\upload\driver\Qnoss;
use EasyAdmin\upload\driver\Txoss;

class Uploadfile
{

    protected static $instance;

    protected $uploadType = 'local';

    protected $uploadConfig;

    protected $file;

    protected $tableName = 'system_uploadfile';

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function setFile($value)
    {
        $this->file = $value;
        return $this;
    }


    public function setUploadConfig($value)
    {
        $this->uploadConfig = $value;
        return $this;
    }

    public function setUploadType($value)
    {
        $this->uploadType = $value;
        return $this;
    }

    public function setTableName($value)
    {
        $this->tableName = $value;
        return $this;
    }

    public function save()
    {
        $obj = null;
        if ($this->uploadType == 'local') {
            $obj = new Local();
        } elseif ($this->uploadType == 'alioss') {
            $obj = new Alioss();
        } elseif ($this->uploadType == 'qnoss') {
            $obj = new Qnoss();
        } elseif ($this->uploadType == 'txoss') {
            $obj = new Txoss();
        }
        $save = $obj->setUploadConfig($this->uploadConfig)
            ->setUploadType($this->uploadType)
            ->setTableName($this->tableName)
            ->setFile($this->file)
            ->save();
        return $save;
    }
}