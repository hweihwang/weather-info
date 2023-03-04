<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\WeatherApi\Responses;

use DateTimeImmutable;
use Exception;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\CastToArrayConcern;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;

final readonly class GetCurrentWeatherApiResponse implements GetCurrentWeatherApiResponseInterface
{
    use CastToArrayConcern;

    private float $temperature;

    private string $temperatureUnit;

    private string $description;

    private string $iconUrl;

    private string $city;

    private string $region;

    private string $country;

    private DateTimeImmutable $localTime;

    private float $windSpeed;

    private string $windDirection;

    private int $humidity;

    private float $pressure;

    private float $visibility;

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): GetCurrentWeatherApiResponseInterface
    {
        try {
            $static = new self();

            $static->temperature = $data['current']['temp_c'];
            $static->temperatureUnit = 'C';
            $static->description = $data['current']['condition']['text'];
            $static->iconUrl = 'https:'.$data['current']['condition']['icon'];
            $static->city = $data['location']['name'];
            $static->region = $data['location']['region'];
            $static->country = $data['location']['country'];
            $static->localTime = new DateTimeImmutable($data['location']['localtime']);
            $static->windSpeed = $data['current']['wind_kph'];
            $static->windDirection = $data['current']['wind_dir'];
            $static->humidity = $data['current']['humidity'];
            $static->pressure = $data['current']['pressure_mb'];
            $static->visibility = $data['current']['vis_km'];

            return $static;
        } catch (Exception $e) {
            throw new Exception('Invalid data');
        }
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getTemperatureUnit(): string
    {
        return $this->temperatureUnit;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLocalTime(): DateTimeImmutable
    {
        return $this->localTime;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getWindDirection(): string
    {
        return $this->windDirection;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function getPressure(): float
    {
        return $this->pressure;
    }

    public function getVisibility(): float
    {
        return $this->visibility;
    }
}
