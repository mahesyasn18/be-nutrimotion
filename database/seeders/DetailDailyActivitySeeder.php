<?php

namespace Database\Seeders;

use App\Models\DetailDailyActivity;
use App\Models\DailyActivity;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class DetailDailyActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua daily activities dan activities yang ada
        $dailyActivities = DailyActivity::all();
        $activities = Activity::all();

        // Iterasi untuk setiap daily activity
        foreach ($dailyActivities as $dailyActivity) {
            // Iterasi untuk setiap activity
            foreach ($activities as $activity) {
                // Buat DetailDailyActivity dengan data random
                DetailDailyActivity::create([
                    'daily_activity_id' => $dailyActivity->id,
                    'activity_id' => $activity->id,
                    'durasi' => rand(30, 120), // Durasi dalam menit
                    'total_kalori' => rand($activity->jumlah_kalori_rendah, $activity->jumlah_kalori_tinggi),
                    'waktu' => now()->format('H:i:s'),
                ]);
            }
        }
    }
}
