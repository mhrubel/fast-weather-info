<?php

namespace FastWeatherInfo\Helpers;

use FastWeatherInfo\Helpers\Providers\VisualCrossing;
use FastWeatherInfo\Helpers\Providers\OpenWeatherMap;

class WeatherProviderManager
{
    public static function getProvider($provider, $apiKey, $cacheExpiry)
    {
        switch ($provider) {
            case 'openweathermap':
                return new OpenWeatherMap($apiKey, $cacheExpiry);
            case 'visualcrossing':
            default:
                return new VisualCrossing($apiKey, $cacheExpiry);
        }
    }

    /**
     * Fetch weather data for the given location and number of days.
     *
     * @param string $location
     * @param int $days
     * @return array
     */
    public static function getWeatherData($location, $days = 2) {
        $provider = self::getProvider();
        return $provider->getWeather($location, $days);
    }
}
