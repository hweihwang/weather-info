<?php

use FullstackChallenge\WeatherInfo\Transports\API\Handlers\GetAllUsersWithWeatherInfoHandler;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'weather-info/api/v1', 'middleware' => ['api']], static function () {
    Route::get('/', GetAllUsersWithWeatherInfoHandler::class);
});
