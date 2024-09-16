<?php

use WPDrill\Facades\Menu;
use WPDrill\Plugin;
use FastWeatherInfo\Handlers\WeatherAdminPage;

return function(Plugin $plugin) {
    Menu::add('Fast Weather Info', WeatherAdminPage::class, 'manage_options')
    ->slug('fast-weather-info')
    ->icon('dashicons-cloud')
    ->position(5);
};
