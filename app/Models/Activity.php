<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_name',
        'jumlah_kalori_rendah',
        'jumlah_kalori_sedang',
        'jumlah_kalori_tinggi',
        'photo'
    ];


    public function detailDailyActivity()
    {
        return $this->hasMany(DetailDailyActivity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
