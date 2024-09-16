<?php

/**
 * Plugin Name:       Fast Weather Info
 * Plugin URI:        https://github.com/mhrubel/fast-weather-info
 * Description:       A simple WordPress plugin to display live weather info based on user location.
 * Version:           1.0.0
 * Author:            Mahamudul Hasan Rubel
 * Author URI:        https://mhr.ractstudio.com/
 * Text Domain:       fast-weather-info
 * Domain Path:       /languages
 * @package           FastWeatherInfo
 * @author            Mahamudul Hasan Rubel <bd.mhrubel@gmail.com>
 * @copyright         Copyright (C) 2024 WPDrill. All rights reserved.
 * @license           GPLv2 or later
 * @since             1.0.0
 */

// don't call the file directly
defined('ABSPATH') || die();

define('FWEATHERI_DIR_PATH', plugin_dir_path(__FILE__));
define('FWEATHERI_PREFIX', 'fwi_');
define('FWEATHERI_FILE', __FILE__);

if (php_sapi_name() === 'cli') {
    return;
}

function fast_weather_info_init()
{
    require __DIR__ . '/vendor/autoload.php';

    call_user_func(function ($bootstrap) {
        $bootstrap(__FILE__);
    }, require(__DIR__ . '/bootstrap/boot.php'));

    // Register Weather Widget
    new \FastWeatherInfo\Helpers\WeatherWidget();
}

fast_weather_info_init();
