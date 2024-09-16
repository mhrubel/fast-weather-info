<?php

namespace FastWeatherInfo\Helpers\Providers;

/**
 * Class OpenCage
 * Handles geocoding requests using the OpenCage API.
 */
class OpenCage
{
    private $apiKey;

    /**
     * OpenCage constructor.
     * Retrieves the API key from WordPress options.
     */
    public function __construct()
    {
        $this->apiKey = get_option('fwi_opencage_api_key'); // Ensure the API key is correctly set in options
    }

    /**
     * Get coordinates for a given location.
     *
     * @param string $location The location to convert to coordinates.
     * @return array|false Coordinates array with 'latitude' and 'longitude', or false on failure.
     */
    public function getCoordinates(string $location)
    {
        $url = sprintf(
            'https://api.opencagedata.com/geocode/v1/json?q=%s&key=%s',
            urlencode($location),
            urlencode($this->apiKey)
        );

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            error_log('OpenCage API Request Error: ' . $response->get_error_message());
            return false;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (!empty($data['results'][0]['geometry'])) {
            return [
                'latitude' => $data['results'][0]['geometry']['lat'],
                'longitude' => $data['results'][0]['geometry']['lng']
            ];
        }

        error_log('OpenCage API Response: ' . print_r($data, true));
        return false;
    }
}
