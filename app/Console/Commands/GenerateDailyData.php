<?php

namespace App\Console\Commands;

use App\Models\DailyNutrition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDailyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailydata:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily data for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            DailyNutrition::create([
                'user_id' => $user->id,
                'tanggal' => Carbon::now(),
                'kalori' => 80,
                'karbohidrat' => 90,
                'protein' => 100,
                'lemak' => 120,
                'serat' => 300,
                'air' => 2000,
            ]);
        }

        $this->info('Daily data generated successfully for all users.');
    }
}
