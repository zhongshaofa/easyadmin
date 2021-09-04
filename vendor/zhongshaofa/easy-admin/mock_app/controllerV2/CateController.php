<?php

namespace MockApp\controllerV2;


use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use MockApp\BaseController;

/**
 * Class CateController
 * @package MockApp\controller
 * @ControllerAnnotation(title="分类管理")
 */
class CateController extends BaseController
{

    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        var_dump(__METHOD__);
    }

    /**
     * @NodeAnotation(title="修改")
     */
    public function edit()
    {
        var_dump(__METHOD__);
    }

    /**
     * @NodeAnotation(title="详情")
     */
    public function detail()
    {
        var_dump(__METHOD__);
    }

    /**
     * @NodeAnotation(title="新增")
     */
    public function add()
    {
        var_dump(__METHOD__);
    }

}