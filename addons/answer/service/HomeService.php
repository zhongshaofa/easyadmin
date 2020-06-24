<?php


namespace addons\answer\service;


class HomeService
{

    public function getCateList()
    {

        return [
            'all' => '全部',
            '1'   => '提问',
            '2'   => '分享',
            '3'   => '示例',
            '4'   => '公告',
        ];

    }

    public function getHomeList()
    {
        return [
            'new'       => '最新',
            'hot'       => '热门',
            'recommend' => '推荐',
            'wait'      => '等待回复',
        ];
    }

}