<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Requests;

use Exception;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetCurrentWeatherApiRequestInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;
use FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Responses\GetCurrentWeatherApiResponse;
use Illuminate\Support\Facades\Http;

final readonly class GetCurrentWeatherApiRequest implements GetCurrentWeatherApiRequestInterface
{
    public function __construct(private string $apiUrl, private string $apiKey)
    {
    }

    /**
     * @throws Exception
     */
    public function send(float $lat, float $lon): GetCurrentWeatherApiResponseInterface
    {
        $rawResponse = Http::get(
            sprintf(
                '%s?q=%s,%s&key=%s',
                $this->apiUrl,
                $lat,
                $lon,
                $this->apiKey
            )
        )->json();

        return GetCurrentWeatherApiResponse::fromArray($rawResponse);
    }
}
