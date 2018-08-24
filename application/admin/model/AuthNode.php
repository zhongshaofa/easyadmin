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

namespace app\admin\model;


use app\common\service\ModelService;

class AuthNode extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'system_auth_node';

    /**
     * 保存授权信息
     * @param $insertAll
     * @return \think\response\Json
     * @throws \Exception
     */
    public function authorize($insertAll) {
        $save = $this->saveAll($insertAll);
        if (!empty($save)) return __success('保存成功！');
        return __error('保存失败');
    }
}