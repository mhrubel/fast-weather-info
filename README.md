# Fast Weather Info `v1.0.0`

The **Fast Weather Info** plugin allows WordPress users to easily display weather information on their site using a widget or shortcode. The plugin supports multiple weather providers and offers customizable options such as location, forecast days, and data types (e.g., current weather, forecast, or sunrise/sunset times). With built-in caching for optimized performance and various display settings, the plugin ensures visitors always receive up-to-date weather information efficiently.

## Key Features

- **Multiple Weather Providers**: Choose from different weather data providers, starting with Visual Crossing, for accurate forecasts and real-time weather.
- **Customizable Shortcode**: Display current weather, forecasts, or sunrise/sunset times with a flexible shortcode.
- **Location Flexibility**: Set weather data for any location worldwide.
- **Unit Selection**: Supports both metric (°C) and imperial (°F) units for temperature.
- **Forecast Display**: Show weather forecasts for up to 15 days.
- **Sunrise and Sunset Info**: Retrieve and display sunrise and sunset times.
- **Caching Options**: Set cache expiry to optimize data requests and performance.
- **Responsive Design**: Ensures a great user experience on all devices.
- **Admin Control**: Customize widget settings, including data type, provider, and cache settings.
- **Email Alerts for Rain**: Notify the admin when there’s a high probability of rain.

## Source Code (Developer Guide)

### Installion

- `gh repo clone mhrubel/fast-weather-info`
- `composer install`
- `npm install`

## Shortcode Usage

To display weather information, use the following shortcode:

[fast_weather_info location="London" unit="metric" days="5" data="forecast" provider="visualcrossing" cache_expiry="60"]

Or, use the shortcode without any parameters to pull from the default admin settings:

[fast_weather_info]

### Parameters

- **location**: Set the location for weather data (e.g., "London", "New York").
- **unit**: Specify temperature unit (metric for Celsius, imperial for Fahrenheit).
- **days**: Number of forecast days to display (e.g., "5").
- **data**: Data type to display: `current`, `forecast`, `sun`, or `all`.
- **provider**: Weather provider to use (e.g., "visualcrossing").
- **cache_expiry**: Set cache expiry time in minutes (e.g., "60").

## Widget Usage

Select the **Weather Info** widget from the block or classic widget options and configure it according to the settings provided in the widget interface.

## Installation

1. Upload the `fast-weather-info` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to the 'Fast Weather Info' menu in the WordPress admin dashboard to configure settings.

## Frequently Asked Questions

**What weather providers are supported?**  
The plugin currently supports Visual Crossing, with OpenWeatherMap in development.

**Can I display weather forecasts for multiple days?**  
Yes, you can specify the number of forecast days using the `days` parameter in the shortcode.

**Does the plugin support different temperature units?**  
Yes, it supports both Celsius (metric) and Fahrenheit (imperial).

**How do I set cache expiry for weather data?**  
You can set cache expiry in the widget settings or via the `cache_expiry` parameter in the shortcode. The expiry time is in minutes.

## Changelog

### 1.0.0

* Initial release of Fast Weather Info plugin.

## Credits

Developed by [Mahamudul Hasan Rubel](https://mhr.ractstudio.com/)

## License

This plugin is licensed under the GPLv2 or later. Full license text: [GPLv2 License](https://www.gnu.org/licenses/gpl-2.0.html)
