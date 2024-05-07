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
        Schema::create('eaten_food', function (Blueprint $table) {
            $table->id();
            $table->foreignId("daily_nutrition_id");
            $table->foreign("daily_nutrition_id")->references("id")->on("daily_nutritions")->onDelete("CASCADE");
            $table->string('food_name');
            $table->enum('food_type', ['berat', 'kemasan']);
            $table->enum('food_category', ['makanan', 'minuman']);
            $table->integer('size');
            $table->integer('kalori')->nullable();
            $table->integer('lemak_total')->nullable();
            $table->integer('protein')->nullable();
            $table->time('eat_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eaten_food');
    }
};
