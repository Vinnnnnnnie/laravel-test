<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = ['make', 'model', 'year', 'color', 'engine_size', 'MOT', 'taxed', 'insured'];

    /** @use HasFactory<\Database\Factories\BikeFactory> */
    use HasFactory;
}

