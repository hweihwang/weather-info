<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses;

final readonly class GetNullCurrentWeatherApiResponse implements GetCurrentWeatherApiResponseInterface
{
    use CastToArrayConcern;

    public static function fromArray(array $data): GetCurrentWeatherApiResponseInterface
    {
        return new self();
    }

    public function getTemperature(): float
    {
        return 0.0;
    }

    public function getTemperatureUnit(): string
    {
        return 'C';
    }

    public function getDescription(): string
    {
        return 'No weather API available';
    }

    public function getIconUrl(): string
    {
        return '';
    }

    public function getCity(): string
    {
        return '';
    }

    public function getWindSpeed(): float
    {
        return 0.0;
    }

    public function getHumidity(): int
    {
        return 0;
    }

    public function getPressure(): float
    {
        return 0.0;
    }

    public function getVisibility(): float
    {
        return 0.0;
    }
}
