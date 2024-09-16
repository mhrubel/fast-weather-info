<?php

namespace FastWeatherInfo\Shortcodes;

use WPDrill\Contracts\ShortcodeContract;
use FastWeatherInfo\Helpers\WeatherProviderManager;

class WeatherShortcodes implements ShortcodeContract
{
    public function render(array $attrs, ?string $content = null): string
    {
        // Fetch default values from admin settings
        $defaultLocation = get_option('fwi_weather_location', 'Dhaka, BD');
        $defaultTempUnit = get_option('fwi_temp_unit', 'metric');
        $defaultProvider = get_option('fwi_weather_provider', 'visualcrossing');
        $defaultDays = get_option('fwi_forecast_days', 7);
        $defaultCacheExpiry = get_option('fwi_cache_duration', 3600); // Default cache expiry (1 hour)

        // Shortcode attributes, allowing override
        $atts = shortcode_atts(
            [
                'location' => $defaultLocation,
                'unit' => $defaultTempUnit,
                'data' => 'all',
                'days' => $defaultDays,
                'provider' => $defaultProvider,
                'cache_expiry' => $defaultCacheExpiry,
            ],
            $attrs,
            'fast_weather_info'
        );

        $location = sanitize_text_field($atts['location']);
        $unit = sanitize_text_field($atts['unit']) === 'imperial' ? 'imperial' : 'metric';
        $dataType = sanitize_text_field($atts['data']);
        $days = intval($atts['days']);
        $provider = sanitize_text_field($atts['provider']);
        $cacheExpiry = intval($atts['cache_expiry']);

        // Fetch API key from settings
        $apiKeys = [
            'openweathermap' => get_option('fwi_openweathermap_api_key', ''),
            'visualcrossing' => get_option('fwi_visualcrossing_api_key', ''),
            'opencage' => get_option('fwi_opencage_api_key', ''),
            'geoapify' => get_option('fwi_geoapify_api_key', ''),
        ];

        $apiKey = $apiKeys[$provider] ?? '';

        // Use WeatherProviderManager to get the appropriate provider instance
        $weatherProvider = WeatherProviderManager::getProvider($provider, $apiKey, $cacheExpiry);
provider: 
        // Determine the type of data to render (current, forecast, sun, all)
        switch ($dataType) {
            case 'current':
                return $weatherProvider->renderCurrentWeather($location, $unit);
            case 'forecast':
                return $weatherProvider->renderForecastWeather($location, $unit, $days);
            case 'sun':
                return $weatherProvider->renderSunsetSunrise($location, $unit);
            case 'all':
            default:
                return $weatherProvider->renderAllWeather($location, $unit, $days);
        }
    }
}
