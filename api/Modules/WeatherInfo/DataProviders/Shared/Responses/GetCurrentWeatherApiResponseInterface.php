<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses;

interface GetCurrentWeatherApiResponseInterface
{
    public static function fromArray(array $data): self;

    public function toArray(): array;

    public function getTemperature(): float;

    public function getTemperatureUnit(): string;

    public function getDescription(): string;

    public function getIconUrl(): string;

    public function getCity(): string;

    public function getWindSpeed(): float;

    public function getHumidity(): int;

    public function getPressure(): float;

    public function getVisibility(): float;
}
