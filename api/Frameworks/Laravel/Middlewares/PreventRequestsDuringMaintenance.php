<?php

declare(strict_types=1);

namespace Frameworks\Laravel\Middlewares;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

final class PreventRequestsDuringMaintenance extends Middleware
{
    protected $except = [];
}
