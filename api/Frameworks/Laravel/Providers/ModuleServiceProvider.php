<?php

declare(strict_types=1);

namespace Frameworks\Laravel\Providers;

use Frameworks\Laravel\Providers\Modules\SharedServiceProvider;
use Frameworks\Laravel\Providers\Modules\WeatherInfoServiceProvider;
use Illuminate\Support\ServiceProvider;

final class ModuleServiceProvider extends ServiceProvider
{
    private const MODULES = [
        SharedServiceProvider::class,
        WeatherInfoServiceProvider::class,
    ];

    public function register(): void
    {
        foreach (self::MODULES as $module) {
            $this->app->register($module);
        }
    }
}
