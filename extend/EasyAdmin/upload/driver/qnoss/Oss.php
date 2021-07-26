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

namespace EasyAdmin\upload\driver\qnoss;


use EasyAdmin\upload\interfaces\OssDriver;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Oss implements OssDriver
{

    protected static $instance;

    protected $accessKey;

    protected $secretKey;

    protected $bucket;

    protected $domain;

    protected $auth;

    public function __construct($config)
    {
        $this->accessKey = $config['qnoss_access_key'];
        $this->secretKey = $config['qnoss_secret_key'];
        $this->bucket = $config['qnoss_bucket'];
        $this->domain = $config['qnoss_domain'];
        $this->auth = new Auth($this->accessKey, $this->secretKey);
        return $this;
    }

    public static function instance($config)
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($config);
        }
        return self::$instance;
    }

    public function save($objectName, $filePath)
    {
        $token = $this->auth->uploadToken($this->bucket);
        $uploadMgr = new UploadManager();
        list($result, $error) = $uploadMgr->putFile($token, $objectName, $filePath);
        if ($error !== null) {
            return [
                'save' => false,
                'msg'  => '保存失败',
            ];
        } else {
            return [
                'save' => true,
                'msg'  => '上传成功',
                'url'  => $this->domain . '/' . $result['key'],
            ];
        }
    }

}