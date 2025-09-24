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
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('color')->nullable();
            $table->string('engine_size')->nullable();
            $table->boolean('MOT')->default(false);
            $table->boolean('taxed')->default(false);
            $table->boolean('insured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
