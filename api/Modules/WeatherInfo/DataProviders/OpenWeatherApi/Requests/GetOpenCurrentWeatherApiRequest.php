<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\OpenWeatherApi\Requests;

use Exception;
use FullstackChallenge\WeatherInfo\DataProviders\OpenWeatherApi\Responses\GetOpenCurrentWeatherApiResponse;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Requests\GetCurrentWeatherApiRequestInterface;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;
use Illuminate\Support\Facades\Http;

final readonly class GetOpenCurrentWeatherApiRequest implements GetCurrentWeatherApiRequestInterface
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
                '%s?lat=%s&lon=%s&appid=%s',
                $this->apiUrl,
                $lat,
                $lon,
                $this->apiKey
            )
        )->json();

        return GetOpenCurrentWeatherApiResponse::fromArray($rawResponse);
    }
}
