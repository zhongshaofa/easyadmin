<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\common\service;

use think\Db;
use think\facade\Config;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuService {

    /**
     * 上传至七牛云
     * @param string $filePath 要上传文件的本地路径
     * @param string $key      上传到七牛后保存的文件名
     * @return mixed
     * @throws \Exception
     */
    public static function upload($filePath = '') {
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = Config::get('qiniu.AccessKey');
        $secretKey = Config::get('qiniu.SecretKey');
        $bucket = Config::get('qiniu.Bucket');
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 要上传文件的本地路径
        $filePath = ".{$filePath}";
        // 上传到七牛后保存的文件名
        $key = md5($filePath) . ToolService::getSuffix($filePath);
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return $err;
        } else {
            $url = Config::get('qiniu.url') . '/' . $ret['key'];
            return $url;
        }
    }

    public static function base64($base64, $key) {
        $accessKey = Config::get('qiniu.AccessKey');
        $secretKey = Config::get('qiniu.SecretKey');
        $bucket = Config::get('qiniu.Bucket');
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucket);
        $uploadMgr = new UploadManager();
        // 上传字符串到七牛
        list($ret, $err) = $uploadMgr->put($token, $key, $base64);
        if ($err !== null) {
            return $err;
        } else {
            return $ret;
        }
    }

    /**
     * 获取七牛云上传token
     * @return string
     */
    public static function getToken() {
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = Config::get('qiniu.AccessKey');
        $secretKey = Config::get('qiniu.SecretKey');
        $bucket = Config::get('qiniu.Bucket');
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        return $token;
    }
}