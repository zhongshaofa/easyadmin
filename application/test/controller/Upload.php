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

namespace app\test\controller;


use app\common\service\QiniuService;
use app\common\service\ToolService;
use think\Db;
use think\Controller;

class Upload extends Controller {

    public function index() {
        $files = request()->file('image');
        if (is_array($files)) {
            foreach ($files as $vo) {
                $info = $vo->move('../public/static/uploads');
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