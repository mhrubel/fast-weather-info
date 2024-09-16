<?php

namespace FastWeatherInfo\Helpers\Providers;

use FastWeatherInfo\Helpers\ConvertLocationToLatLong;
use WPDrill\Facades\Config;

class Geoapify
{
    protected $apiKey;
    protected $baseUrl = 'https://api.geoapify.com/v1/geocode/search';

    public function __construct()
    {
        $this->apiKey = Config::get('fwi_geoapify_api_key');
    }

    /**
     * Convert location to latitude and longitude using Geoapify API.
     *
     * @param string $location The location name to convert.
     * @return array|false An array with 'lat' and 'lon' on success, false on failure.
     */
    public function convertLocationToLatLong(string $location)
    {
        $url = $this->baseUrl . '?text=' . urlencode($location) . '&apiKey=' . $this->apiKey;

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['results'][0]['lat']) && isset($data['results'][0]['lon'])) {
            return [
                'lat' => $data['results'][0]['lat'],
                'lon' => $data['results'][0]['lon'],
            ];
        }

        return false;
    }
}
