<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\common\model\TimeModel;

class SystemCrontabFlow extends TimeModel
{
    protected $table = 'system_crontab_flow';
}
