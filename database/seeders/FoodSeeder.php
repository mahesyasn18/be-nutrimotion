<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'food_name' => 'Apel',
                'picture' => 'apel.jpg',
                'food_type' => 'berat',
                'food_category' => 'makanan',
                'size' => 1, // Misalnya, ukuran dalam gram
            ],
            [
                'food_name' => 'Pisang',
                'picture' => 'pisang.jpg',
                'food_type' => 'berat',
                'food_category' => 'makanan',
                'size' => 1,
            ],
            [
                'food_name' => 'Jeruk',
                'picture' => 'jeruk.jpg',
                'food_type' => 'berat',
                'food_category' => 'makanan',
                'size' => 1,
            ],
            [
                'food_name' => 'Mangga',
                'picture' => 'mangga.jpg',
                'food_type' => 'berat',
                'food_category' => 'makanan',
                'size' => 1,
            ],
            [
                'food_name' => 'Semangka',
                'picture' => 'semangka.jpg',
                'food_type' => 'berat',
                'food_category' => 'makanan',
                'size' => 1,
            ],
        ];

        foreach ($foods as $food) {
            $newFood = Food::create($food);

            // Membuat nilai nutrisi acak untuk setiap makanan
            $nutritionFact = [
                'per_serving' => 100, // Misalnya, per serving dalam gram
                'kalori' => rand(30, 100),
                'lemak_total' => rand(1, 5),
                'protein' => rand(1, 5),
                'karbohidrat_total' => rand(10, 30),
                'gula' => rand(5, 20),
                'serat' => rand(1, 5),
            ];
            $newFood->nutritionFact()->create($nutritionFact);
        }
    }
}
