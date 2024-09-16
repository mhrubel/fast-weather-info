<?php

return [
    'admin' => [
        'scripts' => [
            [
                'handle' => 'fweatheri-admin-script',
                'src'    => 'assets/js/admin.js',
                'deps'   => ['jquery'],
                'ver'    => '1.0.0',
                'in_footer' => true,
            ],
        ],
        'styles' => [
            [
                'handle' => 'fweatheri-admin-style',
                'src'    => 'assets/css/admin.css',
                'deps'   => [],
                'ver'    => '1.0.0',
                'media'  => 'all',
            ],
        ],
    ],
    'frontend' => [
        'scripts' => [
            [
                'handle' => 'fweatheri-frontend-script',
                'src'    => 'assets/js/frontend.js',
                'deps'   => ['jquery'],
                'ver'    => '1.0.0',
                'in_footer' => true,
            ],
        ],
        'styles' => [
            [
                'handle' => 'fweatheri-frontend-style',
                'src'    => 'assets/css/frontend.css',
                'deps'   => [],
                'ver'    => '1.0.0',
                'media'  => 'all',
            ],
        ],
    ],
];
