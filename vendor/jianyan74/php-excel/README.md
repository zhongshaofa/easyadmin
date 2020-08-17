# php-excel

[![Latest Stable Version](https://poser.pugx.org/jianyan74/php-excel/v/stable)](https://packagist.org/packages/jianyan74/php-excel)
[![Total Downloads](https://poser.pugx.org/jianyan74/php-excel/downloads)](https://packagist.org/packages/jianyan74/php-excel)
[![License](https://poser.pugx.org/jianyan74/php-excel/license)](https://packagist.org/packages/jianyan74/php-excel)

## 安装

```
composer require jianyan74/php-excel
```

引入

```
use jianyan\excel\Excel;
```

## Demo

```
// [名称, 字段名, 类型, 类型规则]
$header = [
    ['ID', 'id', 'text'],
    ['手机号码', 'mobile'], // 规则不填默认text
    ['openid', 'fans.openid', 'text'],
    ['昵称', 'fans.nickname', 'text'],
    ['关注/扫描', 'type', 'selectd', [1 => '关注', 2 => '扫描']],
    ['性别', 'sex', 'function', function($model){
        return $model['sex'] == 1 ? '男' : '女';
    }],
    ['创建时间', 'created_at', 'date', 'Y-m-d'],
];

$list = [
    [
        'id' => 1,
        'type' => 1,
        'mobile' => '18888888888',
        'fans' => [
            'openid' => '123',
            'nickname' => '昵称',
        ],
        'sex' => 1,
        'create_at' => time(),
    ]
];
```

### 导出

```
// 简单使用
return Excel::exportData($list, $header);

// 定制 默认导出xlsx 支持 : xlsx/xls/html/csv， 支持写入绝对路径
return Excel::exportData($list, $header, '测试', 'xlsx', '/www/data/');

// 另外一种导出csv方式
return Excel::exportCsvData($list, $header);

```

### 导入

```
/**
 * 导入
 *
 * @param $filePath 文件路径
 * @param int $startRow 开始行数 默认 1
 * @return array|bool|mixed
 */
$data = Excel::import($filePath, $startRow);
```

### 问题反馈

在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

QQ群：[655084090](https://jq.qq.com/?_wv=1027&k=4BeVA2r)

