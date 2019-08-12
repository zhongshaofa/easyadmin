<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\blog\controller\api;

use app\common\controller\BlogController;
use app\common\service\QiniuService;
use think\Db;

class Upload extends BlogController {

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = true;

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
     * 初始化
     * Member constructor.
     */
    public function __construct() {
        parent::__construct();
    }

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