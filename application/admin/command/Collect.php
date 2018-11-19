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

namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\Db;
use tool\Curl;

/**
 * 定时采集任务
 * Class Collect
 * @package app\admin\command
 */
class Collect extends Command {

    protected function configure() {
        $this->setName('collect')
            ->setDescription('自动采集文章！');
    }

    protected function execute(Input $input, Output $output) {
        $url = get_config('spider', 'spider_url');
        $params = [
            'access_key' => get_config('spider', 'spider_access_key'),
            'secret_key' => get_config('spider', 'spider_secret_key'),
        ];
        $result = Curl::request($url, $params);
        if ($result['code'] == 1) {
            P($result['msg']);
            return $result['msg'];
        }
        $total_page = $result['data']['last_page'];
        P('开始采集文章！');
        for ($i = 1; $i <= $total_page; $i++) {
            $params = [
                'access_key' => 'asdfmigshjogsn',
                'secret_key' => 'twjtrowmlca',
                'page'       => $i,
            ];
            $result = Curl::request($url, $params);
            list($data, $insert) = [$result['data']['data'], []];
            foreach ($data as $vo) {
                $article = Db::name('blog_article')->where(['title' => $vo['title'], 'is_deleted' => 0])->find();
                if (empty($article)) {
                    P("正在采集文章：{$vo['title']}");
                    $insert[] = [
                        'category_id' => 1,
                        'member_id'   => 0,
                        'title'       => $vo['title'],
                        'cover_img'   => $vo['cover_img'],
                        'describe'    => $vo['describe'],
                        'content'     => $vo['content'],
                        'clicks'      => $vo['clicks'],
                        'create_at'   => $vo['create_time'],
                    ];
                } else {
                    P("数据库中已存在该文章：{$vo['title']}");
                }
            }
            if (!empty($insert)) {
                Db::startTrans();
                try {
                    Db::name('blog_article')->insertAll($insert);
                    Db::commit();
                } catch (\Exception $e) {
                    P('采集文章失败：' . $e->getMessage());
                    Db::rollback();
                }
                P('采集文章成功！');
            }
        }
        P('文章采集结束!');
        echo '文章采集结束!';
    }
}