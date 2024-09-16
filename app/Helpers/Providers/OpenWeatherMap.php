<?php

namespace FastWeatherInfo\Helpers\Providers;

use FastWeatherInfo\Helpers\WeatherCache;
use WPDrill\Facades\View;
use FastWeatherInfo\Helpers\ConvertFahrenheit;

class OpenWeatherMap
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';
    protected $cache;
    protected $cacheExpiry;

    public function __construct($apiKey, $cacheExpiry = 3600)
    {
        $this->apiKey = $apiKey;
        $this->cache = new WeatherCache();
        $this->cacheExpiry = $cacheExpiry;
    }

    public function getWeather($location, $unit = 'metric', $params = [])
    {
        $params['units'] = $unit;
        $cachedData = $this->cache->loadFromCache('openweather', $location, $params, $this->cacheExpiry);
        if ($cachedData !== false) {
            return $cachedData;
        }

        $url = sprintf(
            '%s/weather?q=%s&units=%s&appid=%s',
            $this->baseUrl,
            urlencode($location),
            $unit,
            $this->apiKey
        );

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return 'Error fetching weather data.';
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        $tz = isset($data['timezone']) ? $data['timezone'] : 'UTC';
        date_default_timezone_set($tz);
        $timestamp = time();
        $cacheTime = date('F j, Y H:i:s', $timestamp);

        $data['cacheTime'] = $cacheTime;
        $data['tempUnit'] = $unit;
        
        $this->cache->saveToCache('openweather', $location, $params, $data);

        return $data;
    }

    public function renderCurrentWeather($location, $unit)
    {
        $data = $this->getWeather($location, $unit);
        if (is_string($data)) {
            return '<p>Error fetching weather data.</p>';
        }

        $current = $data['main'];
        $temperature = $unit === 'metric' ? $current['temp'] : (new ConvertFahrenheit())->convertFahrenheit($current['temp']);
        $feelslike = $unit === 'metric' ? $current['feels_like'] : (new ConvertFahrenheit())->convertFahrenheit($current['feels_like']);

        return View::render('weather/openweather/WeatherCurrentData', [
            'currentConditions' => $current,
            'temp' => $temperature,
            'feelslike' => $feelslike,
            'unit' => $unit === 'imperial' ? 'F' : 'C',
            'location' => $location
        ]);
    }

    public function renderForecastWeather($location, $unit, $days = 7)
    {
        // Implement forecast rendering
    }

    public function renderSunsetSunrise($location, $unit)
    {
        // Implement sunrise and sunset rendering
    }

    public function renderAllWeather($location, $unit, $days = 7)
    {
        // Implement all weather rendering
    }
}
