<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $fillable = ['name', 'location', 'contact_number'];
    /** @use HasFactory<\Database\Factories\GarageFactory> */
    use HasFactory;

    public function bikes() {
        return $this->hasMany(Bike::class);
    }
    // $garage->bikes[0]->make
}
