<?php

namespace FastWeatherInfo\Helpers;

class WeatherCache
{
    protected $cacheDir = WP_CONTENT_DIR . '/fwi-cache';

    public function __construct()
    {
        // Ensure cache directory exists
        if (!is_dir($this->cacheDir)) {
            wp_mkdir_p($this->cacheDir);
        }
    }

    /**
     * Check if caching is enabled via admin settings.
     *
     * @return bool True if caching is enabled, false otherwise.
     */
    public function isCacheEnabled()
    {
        return get_option('fwi_cache_enabled', 1) == 1; // Default to caching enabled
    }

    /**
     * Get cache file path based on provider, location, and params.
     */
    private function getCacheFilePath($provider, $location, $params)
    {
        $hash = md5(serialize($params)); // Create a unique hash for the parameters
        $cacheFilePath = sprintf(
            '%s/%s/%s/%s.json',
            $this->cacheDir,
            sanitize_title($provider),
            sanitize_title($location),
            $hash
        );

        // Create provider and location directories if they do not exist
        $dirPath = dirname($cacheFilePath);
        if (!is_dir($dirPath)) {
            wp_mkdir_p($dirPath);
        }

        return $cacheFilePath;
    }

    /**
     * Save data to cache if caching is enabled.
     */
    public function saveToCache($provider, $location, $params, $data)
    {
        if (!$this->isCacheEnabled()) {
            return false; // Skip caching if disabled
        }

        $cacheFile = $this->getCacheFilePath($provider, $location, $params);
        return file_put_contents($cacheFile, json_encode($data)) !== false;
    }

    /**
     * Load data from cache if caching is enabled.
     */
    public function loadFromCache($provider, $location, $params, $expiry)
    {
        if (!$this->isCacheEnabled()) {
            return false; // Skip cache loading if caching is disabled
        }

        $cacheFile = $this->getCacheFilePath($provider, $location, $params);

        if (!file_exists($cacheFile)) {
            return false; // No cache file exists
        }

        // Check if cache is still valid
        if (filemtime($cacheFile) + $expiry < time()) {
            return false; // Cache expired
        }

        $data = file_get_contents($cacheFile);
        return json_decode($data, true);
    }
}
