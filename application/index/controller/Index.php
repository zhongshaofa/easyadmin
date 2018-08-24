<?php

namespace app\index\controller;


use think\Controller;

class Index extends Controller {

    /**
     * 网站首页
     * @return mixed
     */
    public function index() {
        //数据初始化
        list($this->nav, $this->title) = ['index', '久久PHP社区|PHP开发社区|网站开发'];
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
