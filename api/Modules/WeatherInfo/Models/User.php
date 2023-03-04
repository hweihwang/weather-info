<?php

namespace FullstackChallenge\WeatherInfo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 */
final class User extends Model
{
    public $timestamps = false;
}
