<?php

return [
    'mail_host'     => [
        'title' => 'SMTP地址',
        'type'  => 'text',
        'value' => 'smtp.qq.com',
        'tips'  => '发送方的SMTP服务器地址',
    ],
    'mail_username' => [
        'title' => '邮箱用户名',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '发送方的邮箱用户名',
    ],
    'mail_password' => [
        'title' => '授权登录码',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '发送方的第三方授权登录码',
    ],
    'mail_nickname' => [
        'title' => '发件人昵称',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '如邮件格式说明中的发件人',
    ],
    'mail_reply_to' => [
        'title' => '回复邮箱地址',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '回复邮件将发送到的邮箱地址',
    ],
];