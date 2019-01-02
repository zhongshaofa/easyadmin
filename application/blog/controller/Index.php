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

namespace app\blog\controller;


use app\blog\model\Article;
use app\common\controller\BlogController;

/**
 * 前端首页
 * Class Index
 * @package app\blog\controller
 */
class Index extends BlogController
{

    /**
     * 博客首页
     */
    public function index()
    {
        //基础数据
        $basic_data = [
            'title'               => blogconf('blog', 'SiteName'),
            'keywords'            => blogconf('blog', 'SiteKeywords'),
            'description'         => blogconf('blog', 'SiteDescription'),
            'slider_list'         => model('Slider')->getSliderList(),
            'notice_list'         => model('Notice')->getNoticeList(),
            'recommend_list'      => model('Article')->getRecommendList(),
            'click_ranking_list'  => model('Article')->getClickRankingList(),
            'newest_article_list' => model('Article')->getNewestArticleList(),
            'website_list'        => model('WebsiteLink')->getAllList(),
            'tag_list'            => model('Tag')->getTagList(),
            'ScanFollow'          => blogconf('blog', 'ScanFollow'),
            'blog_user_info'      => [
                'nickname' => blogconf('blog', 'SiteUsername'),
                'job'      => blogconf('blog', 'SiteJob'),
                'email'    => blogconf('blog', 'SiteEmail'),
                'location' => blogconf('blog', 'SiteLocation'),
            ],
        ];
        return $this->fetch('', $basic_data);
    }
}