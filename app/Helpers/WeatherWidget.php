<?php

namespace FastWeatherInfo\Helpers;

use FastWeatherInfo\Helpers\WeatherProviderManager;

class WeatherWidget extends \WP_Widget
{
    // Constructor to initialize the widget
    public function __construct() {
        parent::__construct(
            'weather_widget', // Base ID of your widget
            __('Weather Info', 'fast-weather-info'), // Name of your widget
            ['description' => __('A widget to display weather information.', 'fast-weather-info')]
        );
        
        // Register widget for both block and classic widget editor
        add_action('widgets_init', function () {
            // Register classic widget
            register_widget(__CLASS__);

            // Register block-compatible widget
            if (function_exists('register_widget_type')) {
                register_widget_type([
                    'name'        => 'weather_widget',
                    'title'       => __('Weather Info', 'fast-weather-info'),
                    'description' => __('A widget to display weather information.', 'fast-weather-info'),
                    'render_callback' => [$this, 'renderBlockWidget'],
                ]);
            }
        });
    }

    /**
     * Output the widget content for the block widget editor.
     *
     * @param array $attributes Widget attributes from block editor.
     */
    public function renderBlockWidget($attributes) {
        if (is_admin()) {
            return; // Prevent fetching weather data in admin
        }

        // Extract parameters from block editor attributes
        $location = $attributes['location'] ?? 'New York';
        $unit = $attributes['unit'] ?? 'metric'; // Default to 'metric'
        $days = $attributes['days'] ?? 7;
        $provider = $attributes['provider'] ?? 'visualcrossing';
        $cacheExpiry = $attributes['cache_expiry'] ?? 60; // Default cache expiry (1 hour)
        $dataType = $attributes['data'] ?? 'current'; // Default data type

        // Fetch API key and cache expiry
        $apiKey = $this->getApiKey($provider);

        // Use WeatherProviderManager to get the appropriate provider instance
        $weatherProvider = WeatherProviderManager::getProvider($provider, $apiKey, $cacheExpiry);

        // Render weather data using the provider's method based on the data type
        switch ($dataType) {
            case 'current':
                echo $weatherProvider->renderCurrentWeather($location, $unit);
                break;
            case 'forecast':
                echo $weatherProvider->renderForecastWeather($location, $unit, $days);
                break;
            case 'sun':
                echo $weatherProvider->renderSunsetSunrise($location, $unit);
                break;
            case 'all':
            default:
                echo $weatherProvider->renderAllWeather($location, $unit, $days);
                break;
        }
    }

    /**
     * Output the widget content for the classic widget editor.
     *
     * @param array $args Display arguments including 'before_title', 'after_title', etc.
     * @param array $instance The settings for the particular instance of the widget.
     */
    public function widget($args, $instance) {
        if (is_admin()) {
            return; // Prevent fetching weather data in admin
        }

        // Extract widget settings
        $location = $instance['location'] ?? 'New York';
        $unit = $instance['unit'] ?? 'metric'; // Default to 'metric'
        $days = $instance['days'] ?? 7;
        $provider = $instance['provider'] ?? 'visualcrossing';
        $cacheExpiry = $instance['cache_expiry'] ?? 60; // Default cache expiry (1 hour)
        $dataType = $instance['data'] ?? 'current'; // Default data type

        // Fetch API key and cache expiry
        $apiKey = $this->getApiKey($provider);

        // Use WeatherProviderManager to get the appropriate provider instance
        $weatherProvider = WeatherProviderManager::getProvider($provider, $apiKey, $cacheExpiry);

        // Output widget title and HTML
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Render weather data using the provider's method based on the data type
        switch ($dataType) {
            case 'current':
                echo $weatherProvider->renderCurrentWeather($location, $unit);
                break;
            case 'forecast':
                echo $weatherProvider->renderForecastWeather($location, $unit, $days);
                break;
            case 'sun':
                echo $weatherProvider->renderSunsetSunrise($location, $unit);
                break;
            case 'all':
            default:
                echo $weatherProvider->renderAllWeather($location, $unit, $days);
                break;
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form for classic widget editor.
     * Outputs the options form on the admin side.
     */
    public function form($instance) {
        // Retrieve saved values or set default values
        $title = !empty($instance['title']) ? $instance['title'] : __('Weather Info', 'fast-weather-info');
        $location = !empty($instance['location']) ? $instance['location'] : 'New York';
        $unit = !empty($instance['unit']) ? $instance['unit'] : 'metric'; // Default to 'metric'
        $days = !empty($instance['days']) ? $instance['days'] : 7;
        $provider = !empty($instance['provider']) ? $instance['provider'] : 'visualcrossing';
        $cacheExpiry = !empty($instance['cache_expiry']) ? (int)$instance['cache_expiry'] : 60; // Default cache expiry
        $dataType = !empty($instance['data']) ? $instance['data'] : 'current'; // Default data type

        // Render the admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Location:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo esc_attr($location); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('unit'); ?>"><?php _e('Unit:'); ?></label>
            <select id="<?php echo $this->get_field_id('unit'); ?>" name="<?php echo $this->get_field_name('unit'); ?>">
                <option value="metric" <?php selected($unit, 'metric'); ?>><?php _e('Celsius'); ?></option>
                <option value="imperial" <?php selected($unit, 'imperial'); ?>><?php _e('Fahrenheit'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('data'); ?>"><?php _e('Data Type:'); ?></label>
            <select id="<?php echo $this->get_field_id('data'); ?>" name="<?php echo $this->get_field_name('data'); ?>">
                <option value="current" <?php selected($dataType, 'current'); ?>><?php _e('Current Weather'); ?></option>
                <option value="forecast" <?php selected($dataType, 'forecast'); ?>><?php _e('Forecast Weather'); ?></option>
                <option value="all" <?php selected($dataType, 'all'); ?>><?php _e('All Weather Data'); ?></option>
                <option value="sun" <?php selected($dataType, 'sun'); ?>><?php _e('Sunrise and Sunset'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('days'); ?>"><?php _e('Days of Forecast:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('days'); ?>" name="<?php echo $this->get_field_name('days'); ?>" type="number" min="0" max="15" value="<?php echo esc_attr($days); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('provider'); ?>"><?php _e('Weather Provider:'); ?></label>
            <select id="<?php echo $this->get_field_id('provider'); ?>" name="<?php echo $this->get_field_name('provider'); ?>">
                <option value="visualcrossing" <?php selected($provider, 'visualcrossing'); ?>>Visual Crossing</option>
                <option value="openweathermap" <?php selected($provider, 'openweathermap'); ?>>OpenWeather</option>
                <!-- Add more providers as necessary -->
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cache_expiry'); ?>"><?php _e('Cache Expiry (minutes):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('cache_expiry'); ?>" name="<?php echo $this->get_field_name('cache_expiry'); ?>" type="number" value="<?php echo esc_attr($cacheExpiry); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['location'] = (!empty($new_instance['location'])) ? sanitize_text_field($new_instance['location']) : '';
        $instance['unit'] = (!empty($new_instance['unit'])) ? sanitize_text_field($new_instance['unit']) : 'metric';
        $instance['days'] = (!empty($new_instance['days'])) ? (int)$new_instance['days'] : 7;
        $instance['provider'] = (!empty($new_instance['provider'])) ? sanitize_text_field($new_instance['provider']) : 'visualcrossing';
        $instance['cache_expiry'] = (!empty($new_instance['cache_expiry'])) ? (int)$new_instance['cache_expiry'] : 3600;
        $instance['data'] = (!empty($new_instance['data'])) ? sanitize_text_field($new_instance['data']) : 'current';

        return $instance;
    }

    /**
     * Get API key for the specified provider.
     */
    private function getApiKey($provider) {
        $apiKeys = [
            'openweathermap' => get_option('fwi_openweathermap_api_key', ''),
            'visualcrossing' => get_option('fwi_visualcrossing_api_key', ''),
            'opencage' => get_option('fwi_opencage_api_key', ''),
            'geoapify' => get_option('fwi_geoapify_api_key', ''),
        ];

        return $apiKeys[$provider] ?? '';
    }
}
