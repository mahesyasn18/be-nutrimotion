<?php

namespace Database\Seeders;

use App\Models\DailyActivity;
use Illuminate\Database\Seeder;

class DailyActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            DailyActivity::create([
                'user_id' => $user->id,
                'tanggal' => now()->format('Y-m-d'),
                'kalori' => 100,
            ]);
        }
    }
}
