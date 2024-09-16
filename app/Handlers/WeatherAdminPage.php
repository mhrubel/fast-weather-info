<?php

namespace FastWeatherInfo\Handlers;

use WPDrill\Contracts\InvokableContract;
use WPDrill\Facades\View;

class WeatherAdminPage implements InvokableContract
{
    public function __invoke()
    {

        if (isset($_POST['submit'])) {
        
            // Save the location, email, API keys, temperature unit, email alerts, cache duration, number of days, and weather provider via Options API.
            update_option('fwi_weather_location', sanitize_text_field($_POST['fwi_weather_location']));
            update_option('fwi_rainy_email', sanitize_email($_POST['fwi_rainy_email']));
            
            // Save the VisualCrossing API key securely
            if (isset($_POST['fwi_visualcrossing_api_key']) && !empty($_POST['fwi_visualcrossing_api_key'])) {
                $submittedApiKey = sanitize_text_field($_POST['fwi_visualcrossing_api_key']);
                $storedApiKey = get_option('fwi_visualcrossing_api_key', '');
                
                // Check if the submitted API key is already masked
                if (!preg_match('/^[a-zA-Z0-9]{5}\*{5}[a-zA-Z0-9]{5}$/', $submittedApiKey)) {
                    // If not masked, save the real API key
                    update_option('fwi_visualcrossing_api_key', $submittedApiKey);
                } else {
                    // If masked and the stored key is already valid, do nothing
                    if (empty($storedApiKey) || strlen($storedApiKey) < 10) {
                        update_option('fwi_visualcrossing_api_key', $submittedApiKey);
                    }
                }
            }

            // Save the OpenWeatherMap API key securely
            if (isset($_POST['fwi_openweathermap_api_key']) && !empty($_POST['fwi_openweathermap_api_key'])) {
                $submittedApiKey = sanitize_text_field($_POST['fwi_openweathermap_api_key']);
                $storedApiKey = get_option('fwi_openweathermap_api_key', '');

                // Check if the submitted API key is already masked
                if (!preg_match('/^[a-zA-Z0-9]{5}\*{5}[a-zA-Z0-9]{5}$/', $submittedApiKey)) {
                    // If not masked, save the real API key
                    update_option('fwi_openweathermap_api_key', $submittedApiKey);
                } else {
                    // If masked and the stored key is already valid, do nothing
                    if (empty($storedApiKey) || strlen($storedApiKey) < 10) {
                        update_option('fwi_openweathermap_api_key', $submittedApiKey);
                    }
                }
            }

            // Save the OpenCage API key securely
            if (isset($_POST['fwi_opencage_api_key']) && !empty($_POST['fwi_opencage_api_key'])) {
                $submittedApiKey = sanitize_text_field($_POST['fwi_opencage_api_key']);
                $storedApiKey = get_option('fwi_opencage_api_key', '');

                // Check if the submitted API key is already masked
                if (!preg_match('/^[a-zA-Z0-9]{5}\*{5}[a-zA-Z0-9]{5}$/', $submittedApiKey)) {
                    // If not masked, save the real API key
                    update_option('fwi_opencage_api_key', $submittedApiKey);
                } else {
                    // If masked and the stored key is already valid, do nothing
                    if (empty($storedApiKey) || strlen($storedApiKey) < 10) {
                        update_option('fwi_opencage_api_key', $submittedApiKey);
                    }
                }
            }

            // Save the Geoapify API key securely
            if (isset($_POST['fwi_geoapify_api_key']) && !empty($_POST['fwi_geoapify_api_key'])) {
                $submittedApiKey = sanitize_text_field($_POST['fwi_geoapify_api_key']);
                $storedApiKey = get_option('fwi_geoapify_api_key', '');

                // Check if the submitted API key is already masked
                if (!preg_match('/^[a-zA-Z0-9]{5}\*{5}[a-zA-Z0-9]{5}$/', $submittedApiKey)) {
                    // If not masked, save the real API key
                    update_option('fwi_geoapify_api_key', $submittedApiKey);
                } else {
                    // If masked and the stored key is already valid, do nothing
                    if (empty($storedApiKey) || strlen($storedApiKey) < 10) {
                        update_option('fwi_geoapify_api_key', $submittedApiKey);
                    }
                }
            }

            // Save temperature unit as 'metric' or 'F'
            $tempUnit = sanitize_text_field($_POST['fwi_temp_unit']);
            $tempUnit = $tempUnit === 'imperial' ? 'imperial' : 'metric'; // Only allow 'imperial' or 'metric'
            update_option('fwi_temp_unit', $tempUnit);

            // Save email alerts setting
            update_option('fwi_rainy_email_alerts', isset($_POST['fwi_rainy_email_alerts']) ? 1 : 0);

            // Save cache enable/disable and duration
            $cacheEnabled = isset($_POST['fwi_cache_enabled']) ? 1 : 0;
            update_option('fwi_cache_enabled', $cacheEnabled);

            if ($cacheEnabled) {
            $cacheDuration = intval($_POST['fwi_cache_duration']);
            update_option('fwi_cache_duration', $cacheDuration > 0 ? $cacheDuration : 60); // Default to 60 minutes
            } else {
                update_option('fwi_cache_duration', 0); // Disable caching
            }

            // Save number of days for forecast
            $forecastDays = intval($_POST['fwi_forecast_days']);
            update_option('fwi_forecast_days', ($forecastDays > 0 && $forecastDays <= 15) ? $forecastDays : 7); // Default to 7 days

            // Save weather provider setting
            $weatherProvider = sanitize_text_field($_POST['fwi_weather_provider']);
            $weatherProvider = in_array($weatherProvider, ['openweathermap']) ? $weatherProvider : 'visualcrossing'; // Default to 'visualcrossing'
            update_option('fwi_weather_provider', $weatherProvider);

        }

        // Get saved options
        $weatherLocation = get_option('fwi_weather_location', 'Dhaka, BD');
        $rainyEmail = get_option('fwi_rainy_email', '');
        $tempUnit = get_option('fwi_temp_unit', 'metric'); // Default to 'metric'
        $emailAlerts = get_option('fwi_rainy_email_alerts', 0);
        $cacheEnabled = get_option('fwi_cache_enabled', 1);
        $cacheDuration = get_option('fwi_cache_duration', 60); // Default to 60 minutes
        $forecastDays = get_option('fwi_forecast_days', 7); // Default to 7 days
        $weatherProvider = get_option('fwi_weather_provider', 'visualcrossing'); // Default to 'visualcrossing'

        // Get API keys
        $visualCrossingApiKey = get_option('fwi_visualcrossing_api_key', '');
        $openWeatherMapApiKey = get_option('fwi_openweathermap_api_key', '');
        $opencageApiKey = get_option('fwi_opencage_api_key', '');
        $geoapifyApiKey = get_option('fwi_geoapify_api_key', '');

        // Secure API Key for display
        $apiKeyDisplay = function($apiKey) {
            return strlen($apiKey) > 10 ? substr($apiKey, 0, 5) . '*****' . substr($apiKey, -5) : $apiKey;
        };
        $visualCrossingApiKeyDisplay = $apiKeyDisplay($visualCrossingApiKey);
        $openWeatherMapApiKeyDisplay = $apiKeyDisplay($openWeatherMapApiKey);
        $opencageApiKeyDisplay = $apiKeyDisplay($opencageApiKey);
        $geoapifyApiKeyDisplay = $apiKeyDisplay($geoapifyApiKey);

        // Load the admin view to display the form
        View::output('admin/WeatherAdminSettings', [
            'weather_location' => $weatherLocation,
            'rainy_email' => $rainyEmail,
            'openweathermap_api_key' => $openWeatherMapApiKeyDisplay,
            'opencage_api_key' => $opencageApiKeyDisplay,
            'geoapify_api_key' => $geoapifyApiKeyDisplay,
            'visualcrossing_api_key' => $visualCrossingApiKeyDisplay,
            'temp_unit' => $tempUnit,
            'email_alerts' => $emailAlerts,
            'cache_enabled' => $cacheEnabled,
            'cache_duration' => $cacheDuration,
            'forecast_days' => $forecastDays,
            'weather_provider' => $weatherProvider
        ]);
    }
}