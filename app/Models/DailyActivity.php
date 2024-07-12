<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'kalori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailDailyActivity()
    {
        return $this->hasMany(detailDailyActivity::class);
    }
}
