<?php

use WPDrill\Response;
use WPDrill\Plugin;

if (!function_exists('fweatheri_plugin')) {
    function fweatheri_plugin(): \WPDrill\Plugin
    {
        return \WPDrill\Plugin::getInstance();
    }
}

if (!function_exists('fweatheri_rest')) {
    function fweatheri_rest($data): \WPDrill\Response
    {
        return new Response($data);
    }
}

if (!function_exists('fweatheri_plugin_path')) {
    function fweatheri_plugin_path(string $path = ''): string
    {
        return FWEATHERI_DIR_PATH . ltrim($path, '/');
    }
}

if (!function_exists('fweatheri_plugin_file')) {
    function fweatheri_plugin_file(string $path = ''): string
    {
        return FWEATHERI_FILE;
    }
}

if (!function_exists('fweatheri_resource_path')) {
    function fweatheri_resource_path(string $path = ''): string
    {
        return fweatheri_plugin_path('resources/' . ltrim($path, '/'));
    }
}

if (!function_exists('fweatheri_storage_path')) {
    function fweatheri_storage_path(string $path = ''): string
    {
        return fweatheri_plugin_path('storage/' . ltrim($path, '/'));
    }
}

if (!function_exists('fweatheri_plugin')) {
    function fweatheri_plugin(string $path = ''): Plugin
    {
        return Plugin::getInstance(FWEATHERI_FILE);
    }
}

