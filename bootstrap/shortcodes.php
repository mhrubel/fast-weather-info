<?php

use WPDrill\Facades\Shortcode;
use WPDrill\Plugin;
use FastWeatherInfo\Shortcodes\WeatherShortcodes;

return function (Plugin $plugin) {
    Shortcode::add('fast_weather_info', WeatherShortcodes::class);
};
