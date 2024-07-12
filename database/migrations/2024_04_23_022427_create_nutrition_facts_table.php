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
        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->foreignId("food_id");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("CASCADE");
            $table->integer('per_serving')->nullable();
            $table->integer('kalori')->nullable();
            $table->integer('lemak_total')->nullable();
            $table->integer('lemak_jenuh')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('karbohidrat_total')->nullable();
            $table->integer('gula')->nullable();
            $table->integer('garam')->nullable();
            $table->integer('serat')->nullable();
            $table->integer('vit_a')->nullable();
            $table->integer('vit_d')->nullable();
            $table->integer('vit_e')->nullable();
            $table->integer('vit_k')->nullable();
            $table->integer('vit_b1')->nullable();
            $table->integer('vit_b2')->nullable();
            $table->integer('vit_b3')->nullable();
            $table->integer('vit_b5')->nullable();
            $table->integer('vit_b6')->nullable();
            $table->integer('folat')->nullable();
            $table->integer('vit_b12')->nullable();
            $table->integer('biotin')->nullable();
            $table->integer('kolin')->nullable();
            $table->integer('vit_c')->nullable();
            $table->integer('kalsium')->nullable();
            $table->integer('fosfor')->nullable();
            $table->integer('magnesium')->nullable();
            $table->integer('natrium')->nullable();
            $table->integer('kalium')->nullable();
            $table->integer('mangan')->nullable();
            $table->integer('tembaga')->nullable();
            $table->integer('kromium')->nullable();
            $table->integer('besi')->nullable();
            $table->integer('iodium')->nullable();
            $table->integer('seng')->nullable();
            $table->integer('selenium')->nullable();
            $table->integer('fluor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
};
