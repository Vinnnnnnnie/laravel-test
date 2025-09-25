<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = ['make', 'model', 'year', 'colour', 'engine_size', 'MOT', 'taxed', 'insured', 'garage_id'];

    /** @use HasFactory<\Database\Factories\BikeFactory> */
    use HasFactory;

    public function garage() {
        return $this->belongsTo(Garage::class);
    }

    // $bike->garage->name
}

