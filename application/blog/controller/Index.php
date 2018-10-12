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
class Index extends BlogController {

    /**
     * 博客首页
     */
    public function index() {
        //基础数据
        $basic_data = [
            'keywords'            => '开发者,99PHP,程序媛,极客,编程,代码,开源,IT网站,Developer,Programmer,Coder,Geek,技术社区',
            'description'         => '99PHP社区是一个面向开发者的知识分享社区。自创建以来，99PHP社区一直致力并专注于为开发者打造一个纯净的技术交流社区，推动并帮助开发者通过互联网分享知识，从而让更多开发者从中受益。99PHP社区的使命是帮助开发者用代码改变世界。',
            'slider_list'         => model('Slider')->getSliderList(),
            'notice_list'         => model('Notice')->getNoticeList(),
            'blog_user_info'      => model('Member')->getBlogUserInfo(),
            'recommend_list'      => model('Article')->getRecommendList(),
            'click_ranking_list'  => model('Article')->getClickRankingList(),
            'newest_article_list' => model('Article')->getNewestArticleList(),
            'website_list'        => model('WebsiteLink')->getAllList(),
            'tag_list'            => model('Tag')->getTagList(),
        ];
        return $this->fetch('', $basic_data);
    }
}