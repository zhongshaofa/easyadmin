<?php
namespace app;

// 应用请求对象类
class Request extends \think\Request
{

    protected $filter = ['strip_tags', 'htmlspecialchars'];

}
