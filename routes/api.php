<?php

use WPDrill\Facades\Route;

Route::get('/wpdrill', \FastWeatherInfo\Rest\Controllers\WPDrillController::class)->middleware( \FastWeatherInfo\Rest\Middleware\WPDrillMiddleware::class);
