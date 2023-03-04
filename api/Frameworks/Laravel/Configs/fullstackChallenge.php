<?php

return [
    'weatherApi' => [
        'apiKey' => env('WEATHER_API_KEY'),
        'apiUrl' => env('WEATHER_API_URL'),
    ],

    'openWeatherApi' => [
        'apiKey' => env('OPEN_WEATHER_API_KEY'),
        'apiUrl' => env('OPEN_WEATHER_API_URL'),
    ],

    'cache' => [
        'ttl' => (int) env('WEATHER_INFO_CACHE_IN_MINUTES', 30),
    ],
];
