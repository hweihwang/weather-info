<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->truncate();

        for ($i = 0; $i < 20; $i++) {
            $name = 'User' . mt_rand(1, 1000);
            $latitude = mt_rand(-90 * 1000000, 90 * 1000000) / 1000000.0;
            $longitude = mt_rand(-180 * 1000000, 180 * 1000000) / 1000000.0;

            DB::table('users')->insert([
                'name' => $name,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}
