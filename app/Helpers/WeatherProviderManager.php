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
     * Fetch weather data for the given location, number of days, and unit.
     *
     * @param string $provider
     * @param string $apiKey
     * @param int $cacheExpiry
     * @param string $location
     * @param int $days
     * @param string $unit
     * @return array
     */
    public static function getWeatherData($provider, $apiKey, $cacheExpiry, $location, $days = 2, $unit = 'metric') {
        $providerInstance = self::getProvider($provider, $apiKey, $cacheExpiry);
        return $providerInstance->getWeather($location, $days, $unit);
    }
}
