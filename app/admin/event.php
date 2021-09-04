<?php
// 事件定义文件
return [
    'bind' => [
    ],

    'listen' => [
        'AppInit'  => [
            \app\admin\listener\ViewInitListener::class,
        ],
        'HttpRun'  => [
            \app\admin\listener\ViewInitListener::class,
        ],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],
    ],

    'subscribe' => [
    ],
];
