<?php

return [
    'security'          => [
        'title' => 'SMTP地址',
        'type'  => 'bool',
        'value' => false,
        'tips'  => '是否启用https',
    ],
    'access_key_id'     => [
        'title' => 'AccessKeyId',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '你自己的AccessKeyId',
    ],
    'access_key_secret' => [
        'title' => 'AccessKeySecret',
        'type'  => 'text',
        'value' => '填写自己的',
        'tips'  => '你自己的AccessKeySecret',
    ],
    'content'           => [
        'title' => '短信配置',
        'type'  => 'array',
        'value' => [
            [
                'sign_name'        => [
                    'title' => '短信签名',
                    'type'  => 'text',
                    'value' => '填写自己的',
                    'tips'  => '短信签名，应严格按"签名名称"填写',
                ],
                'template_code'    => [
                    'title' => '短信模板',
                    'type'  => 'text',
                    'value' => '填写自己的',
                    'tips'  => '短信模板Code，应严格按"模板CODE"填写',
                ],
                'template_example' => [
                    'title' => '模板示例',
                    'type'  => 'text',
                    'value' => '填写自己的',
                    'tips'  => '短信模板示例',
                ],
            ],
        ],
        'tips'  => '清输入短信配置',
    ],
];