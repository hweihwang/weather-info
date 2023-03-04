<?php

namespace Frameworks\Laravel\Commands;

use FullstackChallenge\WeatherInfo\Actions\ReindexWeatherInfoAction;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

final class ReIndexUsersWeatherInfoCommand extends Command
{
    protected $signature = 'reindex';

    public function handle(Pipeline $pipeline): void
    {
        $pipeline->through(ReindexWeatherInfoAction::class)->thenReturn();
    }
}
