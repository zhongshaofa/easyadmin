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

use think\Controller;
use think\File;

class Upload extends Controller {

    /**
     * 编辑器多图片上传
     * @return \think\response\Json
     */
    public function image() {
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
        return json(['code' => 0, 'msg' => '上传成功！', 'url' => $url]);
    }

    /**
     * layui图片上传格式
     * @return \think\response\Json
     */
    public function layui_image() {
        $files = request()->file();
        if (is_array($files)) {
            foreach ($files as $vo) {
                $info = $vo->move('../public/static/uploads');
                if ($info) {
                    $data['src'] = '/static/uploads/' . date('Ymd') . '/' . $info->getFilename();
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
        return json(['code' => 0, 'msg' => '上传成功！', 'data' => $data]);
    }
}