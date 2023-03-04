<?php

namespace FullstackChallenge\WeatherInfo\DataProviders\OpenWeatherApi\Responses;

use Exception;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\CastToArrayConcern;
use FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses\GetCurrentWeatherApiResponseInterface;

final readonly class GetOpenCurrentWeatherApiResponse implements GetCurrentWeatherApiResponseInterface
{
    use CastToArrayConcern;

    private float $temperature;

    private string $temperatureUnit;

    private string $description;

    private string $iconUrl;

    private string $city;

    private float $windSpeed;

    private int $humidity;

    private float $pressure;

    private float $visibility;

    private int $sunriseTime;

    private int $sunsetTime;

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): GetCurrentWeatherApiResponseInterface
    {
        try {
            $static = new self();

            $static->temperature = $data['main']['temp'] - 273.15;
            $static->temperatureUnit = 'C';
            $static->description = $data['weather'][0]['description'];
            $static->iconUrl = 'https://openweathermap.org/img/wn/'.$data['weather'][0]['icon'].'.png';
            $static->city = $data['name'];
            $static->windSpeed = $data['wind']['speed'];
            $static->humidity = $data['main']['humidity'];
            $static->pressure = $data['main']['pressure'];
            $static->visibility = $data['visibility'] / 1000;
            $static->sunriseTime = $data['sys']['sunrise'];
            $static->sunsetTime = $data['sys']['sunset'];

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

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
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

    public function getSunriseTime(): int
    {
        return $this->sunriseTime;
    }

    public function getSunsetTime(): int
    {
        return $this->sunsetTime;
    }
}
