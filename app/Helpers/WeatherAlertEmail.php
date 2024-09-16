<?php

namespace FastWeatherInfo\Helpers;

use FastWeatherInfo\Helpers\WeatherProviderManager;
use WPDrill\Facades\View;
use WP_Error;

class WeatherAlertEmail
{
    protected $weatherProviderManager;

    public function __construct()
    {
        // Initialize the WeatherProviderManager
        $this->weatherProviderManager = new WeatherProviderManager();
    }

    /**
     * Send email alerts based on weather data.
     */
    public function sendEmailAlerts()
    {
        // Fetch admin settings
        $adminEmail = get_option('fwi_rainy_email');
        $fallbackLocation = 'Dhaka, BD';
        $defaultTempUnit = get_option('fwi_temp_unit', 'metric');
        $defaultProvider = get_option('fwi_weather_provider', 'visualcrossing');
        $defaultDays = get_option('fwi_forecast_days', 7);

        // Define fallback location if not set
        $location = get_option('fwi_alert_location', $fallbackLocation);

        // Fetch weather provider settings
        $apiKey = $this->getApiKey($defaultProvider);
        if (!$apiKey) {
            error_log('API key for selected weather provider is missing.');
            return;
        }

        // Initialize the weather provider
        $weatherProvider = $this->weatherProviderManager->getProvider($defaultProvider, $apiKey);

        if (!$weatherProvider) {
            error_log('Weather provider could not be initialized.');
            return;
        }

        // Fetch weather data
        $weatherData = $weatherProvider->getWeather($location, $defaultTempUnit, ['days' => $defaultDays]);

        // Check for errors
        if (is_wp_error($weatherData)) {
            error_log('Error fetching weather data: ' . $weatherData->get_error_message());
            return;
        }

        // Determine if there is a 95% or more chance of rain
        $forecast = $weatherData['days'] ?? [];
        foreach ($forecast as $day) {
            if (isset($day['precipprob']) && $day['precipprob'] >= 95) {
                $this->sendAlertEmail($adminEmail, $location, $day);
            }
        }
    }

    /**
     * Get API key based on the provider.
     *
     * @param string $provider
     * @return string|null
     */
    protected function getApiKey($provider)
    {
        $apiKeys = [
            'openweathermap' => get_option('fwi_openweathermap_api_key', ''),
            'visualcrossing' => get_option('fwi_visualcrossing_api_key', ''),
            'opencage' => get_option('fwi_opencage_api_key', ''),
            'geoapify' => get_option('fwi_geoapify_api_key', ''),
        ];

        return $apiKeys[$provider] ?? null;
    }

    /**
     * Send alert email.
     *
     * @param string $to
     * @param string $location
     * @param array $day
     */
    protected function sendAlertEmail($to, $location, $day)
    {
        $subject = 'Weather Alert: High Chance of Rain';
        $message = sprintf(
            "Attention!\n\nThere is a high chance of rain (%.2f%%) in %s on %s.\n\nDetails:\n- Max Temp: %.1f°C\n- Min Temp: %.1f°C\n- Conditions: %s\n- Precipitation: %.2f mm\n- Wind Speed: %.2f km/h\n- Cloud Cover: %.2f%%\n- Pressure: %.2f hPa\n\nStay prepared!",
            $day['precipprob'],
            $location,
            $day['datetime'],
            $day['tempmax'],
            $day['tempmin'],
            $day['conditions'],
            $day['precip'],
            $day['windspeed'],
            $day['cloudcover'],
            $day['pressure']
        );

        wp_mail($to, $subject, $message);
    }
}
