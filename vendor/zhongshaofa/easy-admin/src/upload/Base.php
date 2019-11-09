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


use think\facade\Filesystem;
use think\File;

class Base
{

    protected $uploadConfig;

    protected $file;

    protected $completeFilePath;

    protected $completeFileUrl;

    public function setUploadConfig($value)
    {
        $this->uploadConfig = $value;
        return $this;
    }

    public function setFile($value)
    {
        $this->file = $value;
        return $this;
    }

    public function save()
    {
        $this->completeFilePath = Filesystem::disk('public')->putFile('upload', $this->file);
        $this->completeFileUrl = request()->domain() . '/' . $this->completeFilePath;
    }

    public function rmLocalSave()
    {
        try {
            $rm = unlink($this->completeFilePath);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $rm;
    }

}