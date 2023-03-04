<?php

declare(strict_types=1);

namespace Frameworks\Laravel;

use Frameworks\Laravel\Commands\ReIndexUsersWeatherInfoCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;

final class ConsoleKernel extends Kernel
{
    protected $commands = [
        ReIndexUsersWeatherInfoCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(ReIndexUsersWeatherInfoCommand::class)
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->runInBackground();
    }
}
