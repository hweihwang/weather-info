<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests;

use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;

interface GetCurrentWeatherApiRequestInterface
{
    public function send(float $lat, float $lon): GetCurrentWeatherApiResponseInterface;
}
