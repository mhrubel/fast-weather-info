<?php

namespace FastWeatherInfo\Helpers\Providers;

use FastWeatherInfo\Helpers\WeatherCache;
use WPDrill\Facades\View;
use FastWeatherInfo\Helpers\ConvertFahrenheit;

class VisualCrossing
{
    protected $apiKey;
    protected $baseUrl = 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline';
    protected $cache;
    protected $cacheExpiry;

    public function __construct($apiKey, $cacheExpiry = 3600)
    {
        $this->apiKey = $apiKey;
        $this->cache = new WeatherCache();
        $this->cacheExpiry = $cacheExpiry; // Cache expiry in seconds (default 1 hour)
    }

    /**
     * Get weather data, first check cache, then API.
     */
    public function getWeather($location, $unit = 'metric', $params = [])
    {
        // Include location and unit in params
        $params['unit'] = $unit;
    
        // Try loading from cache if enabled
        $cachedData = $this->cache->loadFromCache('visualcrossing', $location, $params, $this->cacheExpiry);
        if ($cachedData !== false) {
            return $cachedData;
        }
    
        // Fetch from API if no valid cache or caching is disabled
        $url = sprintf(
            '%s/%s?unitGroup=metric&include=current,days&key=%s&contentType=json', // Add include=current,days,hours,events,alerts for more data
            $this->baseUrl,
            urlencode($location),  // weather location
            //$unit,                 // Temperature unit (metric or imperial)
            $this->apiKey          // Provider API key
        );

        $response = wp_remote_get($url);
    
        if (is_wp_error($response)) {
            return 'Error fetching weather data.';
        }
    
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        // Set the timezone
        $tz = isset($data['timezone']) ? $data['timezone'] : 'UTC';
        date_default_timezone_set($tz); // Set the default timezone
        $timestamp = time(); // // Get the current time
        $cacheTime = date('F j, Y H:i:s', $timestamp); // Get the formatted date and time

        // Add to the JSON data
        $data['cacheTime'] = $cacheTime;
        $data['tempUnit'] = 'metric';
        
        // Save the fetched data to cache if enabled
        $this->cache->saveToCache('visualcrossing', $location, $params, $data);
    
        return $data;
    }
    
    /**
     * Render the current weather data.
     *
     * @param string $location The location.
     * @param string $unit The temperature unit ('metric' for Celsius, 'imperial' for Fahrenheit).
     * @return string The rendered HTML for the current weather.
     */
    public function renderCurrentWeather($location, $unit)
    {
        // Fetch the weather data
        $data = $this->getWeather($location, $unit);
        
        // Check if there was an error fetching the data
        if (is_string($data)) {
            return '<p>Error fetching weather data.</p>';
        }
    
        // Extract the current conditions
        $current = $data['currentConditions'];

        // Convert temperature if needed
        $temperature = $unit === 'metric' ? $current['temp'] : (new convertFahrenheit())->convertFahrenheit($current['temp']);
        $feelslike = $unit === 'metric' ? $current['feelslike'] : (new convertFahrenheit())->convertFahrenheit($current['feelslike']);
    
        // Render the current weather using the Twig template
        return View::render('weather/visualcrossing/WeatherCurrentData', [
            'resolvedAddress' => $data['resolvedAddress'],
            'datetime' => $data['cacheTime'],
            'timezone' => $data['timezone'],
            'currentConditions' => $current,
            'temp' => $temperature,
            'feelslike' => $feelslike,
            'unit' => $unit === 'imperial' ? 'F' : 'C',
            'location' => $location
        ]);
    }

    /**
     * Render the weather forecast.
     *
     * @param string $location The location.
     * @param string $unit The temperature unit ('metric' for Celsius, 'imperial' for Fahrenheit).
     * @param int $days The number of days for forecast.
     * @return string The rendered HTML for the weather forecast.
     */
    public function renderForecastWeather($location, $unit, $days = 7)
    {
        // Fetch the weather data
        $data = $this->getWeather($location, $unit);
        
        // Check if there was an error fetching the data
        if (is_string($data)) {
            return '<p>Error fetching weather data.</p>';
        }
        
        // Extract the forecast data
        $forecast = array_slice($data['days'], 0, $days);
        
        // Convert temperatures if needed
        foreach ($forecast as &$day) {
            $day['tempmax'] = $unit === 'metric' ? $day['tempmax'] : (new ConvertFahrenheit())->convertFahrenheit($day['tempmax']);
            $day['tempmin'] = $unit === 'metric' ? $day['tempmin'] : (new ConvertFahrenheit())->convertFahrenheit($day['tempmin']);
        }
        
        // Debugging output
        error_log(print_r($forecast, true));
        
        // Render the forecast using the Twig template
        return View::render('weather/visualcrossing/WeatherForecastData', [
            'resolvedAddress' => $data['resolvedAddress'],
            'datetime' => $data['cacheTime'],
            'timezone' => $data['timezone'],
            'days' => $forecast,
            'unit' => $unit === 'imperial' ? 'F' : 'C',
            'location' => $location
        ]);
    }
    

    /**
     * Render the sunrise and sunset times.
     *
     * @param string $location The location.
     * @param string $unit The temperature unit.
     * @return string The rendered HTML for sunrise and sunset times.
     */
    public function renderSunsetSunrise($location, $unit)
    {
        // Fetch the weather data
        $data = $this->getWeather($location, $unit);
        
        // Check if there was an error fetching the data
        if (is_string($data)) {
            return '<p>Error fetching weather data.</p>';
        }
    
        // Extract sunrise and sunset times
        $sunrise = date('H:i', strtotime($data['currentConditions']['sunrise']));
        $sunset = date('H:i', strtotime($data['currentConditions']['sunset']));
        $moonphase = $data['currentConditions']['moonphase'];
    
        // Render the sunrise and sunset times using the Twig template
        return View::render('weather/visualcrossing/WeatherSunSetRiseData', [
            'sunrise' => $sunrise,
            'sunset' => $sunset,
            'moonphase' => $moonphase,
            'datetime' => $data['cacheTime'],
            'timezone' => $data['timezone']
        ]);
    }

    /**
     * Render all weather data (current, forecast, sunrise/sunset).
     *
     * @param string $location The location.
     * @param string $unit The temperature unit ('metric' for Celsius, 'imperial' for Fahrenheit).
     * @param int $days The number of days for forecast.
     * @return string The rendered HTML for all weather data.
     */
    public function renderAllWeather($location, $unit, $days = 7)
    {
        $data = $this->getWeather($location, $unit);
    
        if (is_string($data)) {
            return '<p>Error fetching weather data.</p>';
        }

        $current = $data['currentConditions'];
        $forecast = array_slice($data['days'], 0, $days);
        
        // Adjust temperature based on unit
        $temperature = $unit === 'metric' ? $current['temp'] : (new ConvertFahrenheit())->convertFahrenheit($current['temp']);
        $feelslike = $unit === 'metric' ? $current['feelslike'] : (new ConvertFahrenheit())->convertFahrenheit($current['feelslike']);
        
        // Format sunrise and sunset times
        $sunrise = date('H:i', strtotime($current['sunrise']));
        $sunset = date('H:i', strtotime($current['sunset']));
        
        // Prepare data for Twig template
        $viewData = [
            'resolvedAddress' => $data['resolvedAddress'],
            'datetime' => $data['cacheTime'],
            'timezone' => $data['timezone'],
            'currentConditions' => [
                'temp' => $temperature,
                'feelslike' => $feelslike,
                'unit' => $unit === 'imperial' ? 'F' : 'C',
                'humidity' => $current['humidity'],
                'precip' => $current['precip'],
                'windspeed' => $current['windspeed'],
                'pressure' => $current['pressure'],
                'visibility' => $current['visibility'],
                'conditions' => $current['conditions'],
                'cloudcover' => $current['cloudcover'],
                'uvindex' => $current['uvindex'],
                'sunrise' => $sunrise,
                'sunset' => $sunset,
                'moonphase' => $current['moonphase']
            ],
            'days' => array_map(function($day) use ($unit) {
                return [
                    'datetime' => $day['datetime'],
                    'tempmax' => $unit === 'metric' ? $day['tempmax'] : (new ConvertFahrenheit())->convertFahrenheit($day['tempmax']),
                    'tempmin' => $unit === 'metric' ? $day['tempmin'] : (new ConvertFahrenheit())->convertFahrenheit($day['tempmin']),
                    'unit' => $unit === 'imperial' ? 'F' : 'C',
                    'conditions' => $day['conditions'],
                    'precip' => $day['precip'],
                    'precipprob' => $day['precipprob'],
                    'windspeed' => $day['windspeed'],
                    'cloudcover' => $day['cloudcover'],
                    'pressure' => $day['pressure']
                ];
            }, $forecast),
        ];
    
        return View::render('weather/visualcrossing/WeatherAllData', $viewData);
    }
    
}
