<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EatenFood extends Model
{
    use HasFactory;

    protected $table = 'eaten_food';
    protected $fillable = [
        'daily_nutrition_id',
        'food_name',
        'food_type',
        'food_category',
        'size',
        'kalori',
        'karbohidrat',
        'lemak_total',
        'protein',
        'eat_time',
    ];

    public function dailyNutrition()
    {
        return $this->belongsTo(DailyNutrition::class);
    }
}
