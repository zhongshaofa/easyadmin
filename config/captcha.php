<?php
/**
 * 验证码控制
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\9 0009
 * Time: 18:07
 */

// +----------------------------------------------------------------------
// | 验证码设置
// +----------------------------------------------------------------------

return [
    // 验证码字符集合
    // 'codeSet'  => '0123456789',
    // 验证码字体大小(px)
    'fontSize' => 16,
    // 验证码位数
    'length'   => 4,
    // 验证码图片高度
    'imageH'   => 36,
    // 验证码图片宽度
    'imageW'   => 116,
    // 是否画混淆曲线
    'useCurve' => false,
    // 是否添加杂点
    'useNoise' => false,
    // 验证后重置
    'reset'    => true,
    // 验证码字体，目录\vendor\topthink\think-captcha\assets\ttfs
    'fontttf'  => '4.ttf',
    //背脊颜色
    'bg'       => [255, 255, 255],
];