<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_activity_id',
        'activity_id',
        'durasi',
        'total_kalori',
        'waktu',
    ];

    public function dailyActivity()
    {
        return $this->belongsTo(DailyActivity::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
