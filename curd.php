<?php

return [
    'table' => [
        'blog_user',
        'blog_type',
    ],
    'index' => [
        'field'  => [
            'blog_user.id',
            'blog_user.username',
            'blog_user.sex',
            'blog_type.title',
            'blog_type.id',
        ],
        'banner' => 'add,del',
        'operat' => 'edit,del',
    ],
];