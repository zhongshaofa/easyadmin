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

namespace EasyAdmin\upload\driver\alioss;

use EasyAdmin\upload\interfaces\OssDriver;
use OSS\Core\OssException;
use OSS\OssClient;

class Oss implements OssDriver
{

    protected static $instance;

    protected $accessKeyId;

    protected $accessKeySecret;

    protected $endpoint;

    protected $bucket;

    protected $domain;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function setConfig($config)
    {
        $this->accessKeyId = $config['alioss_access_key_id'];
        $this->accessKeySecret = $config['alioss_access_key_secret'];
        $this->endpoint = $config['alioss_endpoint'];
        $this->bucket = $config['alioss_bucket'];
        $this->domain = $config['alioss_domain'];
        return $this;
    }

    public function save($filePath)
    {
        try {
            $ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
            $upload = $ossClient->uploadFile($this->bucket, $filePath, $filePath);
        } catch (OssException $e) {
            return [
                'save' => false,
                'msg'  => $e->getMessage(),
            ];
        }
        if (!isset($upload['info']['url'])) {
            return [
                'save' => true,
                'msg'  => '保存失败',
            ];
        }
        return [
            'save' => true,
            'msg'  => '保存成功',
            'url'  => $upload['info']['url'],
        ];
    }

}