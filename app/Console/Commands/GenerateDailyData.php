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
        $currentDate = Carbon::now();
        foreach ($users as $user) {
            $age = $currentDate->diffInYears(Carbon::parse($user->birthday));
            if ($user->gender == 'Laki-laki'){
                $calori = (10*$user->weight) + (6.25*$user->height) - (5*$age) + 5;
            }else{
                $calori = (10*$user->weight) + (6.25*$user->height) - (5*$age) - 161;
            }
            $carb = (0.45*$calori)/4;
            DailyNutrition::create([
                'user_id' => $user->id,
                'tanggal' => $currentDate,
                'kalori' => $calori,
                'karbohidrat' => (int)$carb,
                'protein' => (int)$user->weight,
                'lemak' => (int)$user->weight,
                'air' => 0,
            ]);
        }

        $this->info('Daily data generated successfully for all users.');
    }
}
