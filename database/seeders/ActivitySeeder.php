<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
            'activity_name' => 'Jogging',
            'jumlah_kalori_rendah' => 100,
            'jumlah_kalori_sedang' => 200,
            'jumlah_kalori_tinggi' => 300,
            'photo' => 'jogging.jpg'
        ]);

        Activity::create([
            'activity_name' => 'Cycling',
            'jumlah_kalori_rendah' => 150,
            'jumlah_kalori_sedang' => 300,
            'jumlah_kalori_tinggi' => 450,
            'photo' => 'cycling.jpg'
        ]);
    }
}
