<?php

declare(strict_types=1);

namespace FullstackChallenge\WeatherInfo\DataProviders\Shared\Responses;

trait CastToArrayConcern
{
    public function toArray(): array
    {
        return [
            'temperature' => $this->getTemperature(),
            'temperatureUnit' => $this->getTemperatureUnit(),
            'description' => $this->getDescription(),
            'iconUrl' => $this->getIconUrl(),
            'city' => $this->getCity(),
            'windSpeed' => $this->getWindSpeed(),
            'humidity' => $this->getHumidity(),
            'pressure' => $this->getPressure(),
            'visibility' => $this->getVisibility(),
        ];
    }
}
