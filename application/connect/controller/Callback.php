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

namespace app\connect\controller;


use think\Controller;

class Callback extends Controller {

    public function qq() {
        //请求accesstoken
        $oauth = new \qq_connect\Oauth();
        $accesstoken = $oauth->qq_callback();
        //获取open_id
        $openid = $oauth->get_openid();

        //设置有效时长(7天)
        cookie('accesstoken', $accesstoken, 24 * 60 * 60 * 7);
        cookie('openid', $openid, 24 * 60 * 60 * 7);

        //根据accesstoken和open_id获取用户的基本信息
        $qc = new \qq_connect\QC($accesstoken, $openid);
        $userinfo = $qc->get_user_info();
        dump($openid);
        dump($userinfo);
    }
}