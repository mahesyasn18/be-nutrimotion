<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DailyActivity;
use App\Models\DetailDailyActivity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            FoodSeeder::class,
            ActivitySeeder::class,
            DailyActivitySeeder::class,
            DetailDailyActivity::class,
        ]);
    }
}
