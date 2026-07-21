<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recipe_ingredient', function (Blueprint $table) {
            $table->foreignId('recipe_id');
            $table->foreignId('ingredient_id');
            $table->integer('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredient');
    }
};
