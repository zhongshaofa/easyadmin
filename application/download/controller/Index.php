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

namespace app\download\controller;


use think\Controller;

class Index extends Controller {

    /**
     * 网站首页
     * @return mixed
     */
    public function index() {
        //数据初始化
        list($this->nav, $this->title) = ['index', '99Admin - 基于ThinkPHP5.1和Layui的快速后台开发框架 '];
        //数据渲染
        $basic_data = [
            'title'        => $this->title,
            'data'         => model('\app\download\model\Config')->getConfig(),
            'download_sum' => model('\app\download\model\Record')->getDownloadSum(),
        ];
        return $this->fetch('', $basic_data);
    }


    /**
     * 程序下载统计
     */
    public function download() {
        if (!$this->request->isPost()) {
            //获取位置信息
            $location_info = get_location();
            $data = [
                'ip'       => get_ip(),
                'country'  => $location_info['country'],
                'region'   => $location_info['region'],
                'city'     => $location_info['city'],
                'isp'      => $location_info['isp'],
                'location' => $location_info['country'] . $location_info['region'] . $location_info['city'] . $location_info['isp'],
                'remark'   => '下载程序',
            ];
            //保存用户下载时的数据
            model('\app\download\model\Record')->save($data);
            return json(['code' => 0, 'mag' => '正在进行下载！']);
        }
    }

}