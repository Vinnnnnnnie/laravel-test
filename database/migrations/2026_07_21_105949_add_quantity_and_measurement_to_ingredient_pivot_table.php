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
        Schema::table('recipe_ingredient', function (Blueprint $table) {
            $table->float('quantity')->default(1)->after('ingredient_id');
            $table->enum('measurement', [
                'g',
                'tsp',
                'tbsp',
                'ml',
                'l',
                'kg',
                'cup',
                ''])->default('')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipe_ingredient', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('measurement');
        });
    }
};
