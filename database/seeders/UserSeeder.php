<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'fullname' => 'John Doe',
                'email' => '    ',
                'password' => Hash::make('password123'),
                'weight' => 70,
                'height' => 175,
                'gender' => 'male',
                'birthday' => '1990-01-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullname' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'password' => Hash::make('password123'),
                'weight' => 60,
                'height' => 165,
                'gender' => 'female',
                'birthday' => '1992-02-02',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullname' => 'Alice Smith',
                'email' => 'alicesmith@example.com',
                'password' => Hash::make('password123'),
                'weight' => 55,
                'height' => 160,
                'gender' => 'female',
                'birthday' => '1985-03-03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullname' => 'Bob Johnson',
                'email' => 'bobjohnson@example.com',
                'password' => Hash::make('password123'),
                'weight' => 80,
                'height' => 180,
                'gender' => 'male',
                'birthday' => '1980-04-04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullname' => 'Charlie Brown',
                'email' => 'charliebrown@example.com',
                'password' => Hash::make('password123'),
                'weight' => 75,
                'height' => 170,
                'gender' => 'male',
                'birthday' => '1995-05-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}