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

/**
 * 基类
 * Class Base
 * @package EasyAdmin\upload
 */
class FileBase
{

    /**
     * 上传配置
     * @var array
     */
    protected $uploadConfig;

    /**
     * 上传文件对象
     * @var object
     */
    protected $file;

    /**
     * 上传完成的文件路径
     * @var string
     */
    protected $completeFilePath;

    /**
     * 上传完成的文件的URL
     * @var string
     */
    protected $completeFileUrl;

    /**
     * 保存上传文件的数据表
     * @var string
     */
    protected $tableName;

    /**
     * 上传类型
     * @var string
     */
    protected $uploadType = 'local';

    /**
     * 设置上传方式
     * @param $value
     * @return $this
     */
    public function setUploadType($value)
    {
        $this->uploadType = $value;
        return $this;
    }

    /**
     * 设置上传配置
     * @param $value
     * @return $this
     */
    public function setUploadConfig($value)
    {
        $this->uploadConfig = $value;
        return $this;
    }

    /**
     * 设置上传配置
     * @param $value
     * @return $this
     */
    public function setFile($value)
    {
        $this->file = $value;
        return $this;
    }

    /**
     * 设置保存文件数据表
     * @param $value
     * @return $this
     */
    public function setTableName($value)
    {
        $this->tableName = $value;
        return $this;
    }

    /**
     * 保存文件
     */
    public function save()
    {
        $this->completeFilePath = Filesystem::disk('public')->putFile('upload', $this->file);
        $this->completeFileUrl = request()->domain() . '/' . str_replace(DIRECTORY_SEPARATOR, '/', $this->completeFilePath);
    }

    /**
     * 删除保存在本地的文件
     * @return bool|string
     */
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