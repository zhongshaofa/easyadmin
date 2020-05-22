<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class TestGoods extends TimeModel
{

    protected $name = "test_goods";

    protected $deleteTime = 'delete_time';

    
    public function testCate()
    {
        return $this->belongsTo('\app\admin\model\TestCate', 'cate_id', 'id');
    }

    
    public function getSexList()
    {
        return ['1'=>'男','2'=>'女','0'=>'未知',];
    }

    public function getModeList()
    {
        return ['1'=>'正常购买','2'=>'秒杀活动',];
    }

    public function getStatusList()
    {
        return ['0'=>'禁用','1'=>'启用',];
    }


}