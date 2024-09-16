<?php

return [
    'name' => 'Fast Weather Info',
    'slug' => 'fast-weather-info',
    'prefix' => 'fweatheri',
    'rest_api_namespace' => 'fweatheri',
    'version' => '0.0.1',

    'initial_handlers' => [
        'activated' => \FastWeatherInfo\Handlers\PluginActivatedHandler::class,
        'deactivated' => null,
        'uninstalled' => null,
    ],

    'providers' => [
        \WPDrill\Providers\ShortcodeServiceProvider::class,
        \WPDrill\Providers\DBServiceProvider::class,
        \WPDrill\Providers\RequestServiceProvider::class,
        \WPDrill\Providers\MenuServiceProvider::class,
        \WPDrill\Providers\ViewServiceProvider::class,
        \WPDrill\Providers\ConfigServiceProvider::class,
        \WPDrill\Providers\EnqueueServiceProvider::class,
        \WPDrill\Providers\RoutingServiceProvider::class,
        \WPDrill\Providers\MigrationServiceProvider::class,
        \WPDrill\Providers\CommonServiceProvider::class,


        \FastWeatherInfo\Providers\PluginServiceProvider::class,
    ],
];
