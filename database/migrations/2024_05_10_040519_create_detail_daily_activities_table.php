<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_daily_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId("daily_activity_id");
            $table->foreign("daily_activity_id")->references("id")->on("daily_activities")->onDelete("CASCADE");
            $table->foreignId("activity_id");
            $table->foreign("activity_id")->references("id")->on("activities")->onDelete("CASCADE");
            $table->integer("durasi");
            $table->time("waktu");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_daily_activities');
    }
};
