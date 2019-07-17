<?php


namespace app\common\model;


use think\Model;

class SystemAdmin extends Model
{

    use \think\model\concern\SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

}