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

namespace app\admin\controller\api;


use app\common\controller\AdminController;
use app\common\service\QiniuService;
use think\Db;
use think\File;

/**
 * 后台上传通用接口
 * Class Upload
 * @package app\admin\controller\api
 */
class Upload extends AdminController
{

    /**
     * 允许上传文件大小
     * @var int
     */
    protected $size = 10240000;

    /**
     * 允许上传文件类型
     * @var int
     */
    protected $fileType = 'jpg,jpeg,png,gif,ico,bmp,tiff,psd,swf,svg,zip,rar,gz,7z,doc,docx,excel';

    /**
     * 编辑器多图片上传
     * @param null $fileType 允许上传文件类型
     * @return \think\response\Json
     * @throws \Exception
     */
    public function image($fileType = null)
    {
        $files = request()->file();
        !empty($fileType) && $this->fileType = $fileType;
        if (is_array($files)) {
            foreach ($files as $vo) {
                $info = $vo->validate(['size' => $this->size, 'ext' => $this->fileType])->move('../public/static/uploads');
                if ($info) {
                    $url[] = '/static/uploads/' . date('Ymd') . '/' . $info->getFilename();
                } else {
                    return json(['code' => 1, 'msg' => $vo->getError()]);
                }
            }
        } else {
            $info = $files->move('../public/static/uploads');
            if ($info) {
                $url[] = '/static/uploads/' . date('Ymd') . '/' . $info->getFilename();
            } else {
                return json(['code' => 1, 'msg' => $files->getError()]);
            }
        }
        //判断是否使用七牛云上传
        $file_type = Db::name('SystemConfig')->where(['name' => 'FileType', 'group' => 'file'])->value('value');
        if ($file_type == 2) {
            foreach ($url as &$vo) {
                $vo = QiniuService::upload($vo);
            }
        }
        return json(['code' => 0, 'msg' => '上传成功！', 'url' => $url]);
    }

}