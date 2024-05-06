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
        Schema::create('daily_nutritions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("CASCADE");
            $table->date('tanggal');
            $table->integer('kalori')->nullable();
            $table->integer('karbohidrat')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('lemak')->nullable();
            $table->integer('serat')->nullable();
            $table->integer('air')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_nutrition');
    }
};
