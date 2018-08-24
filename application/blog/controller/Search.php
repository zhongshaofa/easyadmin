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


use app\common\controller\BlogController;

class Search extends BlogController {

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Article');
    }

    /**
     * 搜索首页
     * @return mixed
     */
    public function index($word = '', $category_id = '') {
        $search_data = $this->model->searchArticle($word, $category_id);
        $basic_data = [
            'title'          => '搜索资料',
            'recommend_list' => $this->model->getRecommendList(),
            'category_list'  => model('Category')->getCategoryList(),
            'search_count'   => $search_data['count'],
            'search_list'    => $search_data['list'],
        ];
        return $this->fetch('', $basic_data);
    }

}