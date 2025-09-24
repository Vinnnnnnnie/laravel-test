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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('ingredients');
            $table->text('instructions');
            $table->integer('preparation_time'); // in minutes
            $table->integer('cooking_time'); // in minutes
            $table->integer('servings');
            $table->string('difficulty'); // e.g., Easy, Medium, Hard
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
