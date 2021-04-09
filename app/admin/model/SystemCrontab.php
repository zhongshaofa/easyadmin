<?php
declare (strict_types=1);

namespace app\admin\model;

use app\common\model\TimeModel;

class SystemCrontab extends TimeModel
{
    const FORBIDDEN_STATUS = 0;
    const NORMAL_STATUS = 1;

    public static function statusText()
    {
        return [
            ['title' => '禁用', 'value' => self::FORBIDDEN_STATUS],
            ['title' => '启用', 'value' => self::NORMAL_STATUS]
        ];
    }

    public static function typeText()
    {
        return [
            ['title' => '请求url', 'value' => 0],
            ['title' => '执行sql', 'value' => 1],
            ['title' => '执行shell', 'value' => 2]
        ];
    }

    public function flow()
    {
        return $this->hasMany(SystemCrontabFlow::class, 'sid', 'id');
    }
}
