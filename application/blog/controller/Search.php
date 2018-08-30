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
     * @param string $word
     * @param string $type
     * @param string $category_id
     * @return mixed
     */
    public function index($word = '', $type = '', $category_id = '') {
        !empty($word) && $this->save_record($word, $type);
        $search_data = $this->model->searchArticle($word, $category_id);
        $basic_data = [
            'title'          => '搜索资料',
            'recommend_list' => $this->model->getRecommendList(),
            'category_list'  => model('Category')->getCategoryList(),
            'search_count'   => $search_data['count'],
            'search_list'    => $search_data['list'],
            'search_rank'    => model('Search')->getRank(),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 保存搜索记录
     * @param $word 关键词
     * @param $type 搜索类型
     */
    protected function save_record($word, $type) {
        !empty($this->member) ? $member_id = $this->member['id'] : $member_id = 0;

        switch ($type) {
            case 'article':
                list($type, $remark) = [1, '正在搜索文章！'];
                break;
            case  'tag':
                list($type, $remark) = [2, '正在搜索文章！'];
                break;
            default:
                list($type, $remark) = [0, '正在搜索文章！'];
        }

        $save = [
            'word'      => $word,
            'type'      => $type,
            'member_id' => $member_id,
            'ip'        => get_ip(),
            'remark'    => $remark,
        ];

        model('Search')->saveSearch($word);
        model('SearchRecord')->save($save);
    }

}