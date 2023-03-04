<?php

declare(strict_types=1);

namespace Frameworks\Laravel;

use Illuminate\Foundation\Application as LaravelApplication;

final class Application extends LaravelApplication
{
    /**
     * {@inheritdoc}
     */
    public function path($path = ''): string
    {
        return $this->basePath.'/Modules/'.($path ? '/'.$path : $path);
    }

    public function configPath($path = ''): string
    {
        return $this->basePath.'/Frameworks/Laravel/Configs/'.($path ? '/'.$path : $path);
    }

    public function databasePath($path = ''): string
    {
        return $this->basePath.'/Frameworks/Laravel/Database/'.($path ? '/'.$path : $path);
    }
}
