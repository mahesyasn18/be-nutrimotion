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
        Schema::table('detail_daily_activities', function (Blueprint $table) {
            $table->string("total_kalori")->after("durasi");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_daily_activities', function (Blueprint $table) {
            $table->dropColumn('total_kalori');
        });
    }
};
