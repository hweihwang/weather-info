<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests;

use Exception;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetNullCurrentWeatherApiResponse;

final readonly class GetChainCurrentWeatherApiRequest implements GetCurrentWeatherApiRequestInterface
{
    /**
     * @throws Exception
     */
    public function __construct(private iterable $requests)
    {
        foreach ($this->requests as $request) {
            if (! ($request instanceof GetCurrentWeatherApiRequestInterface)) {
                throw new Exception('Invalid request');
            }
        }
    }

    /**
     * @throws Exception
     */
    public function send(float $lat, float $lon): GetCurrentWeatherApiResponseInterface
    {
        foreach ($this->requests as $request) {
            try {
                return $request->send($lat, $lon);
            } catch (Exception $e) {
                report($e);

                continue;
            }
        }

        return GetNullCurrentWeatherApiResponse::fromArray([]);
    }
}
