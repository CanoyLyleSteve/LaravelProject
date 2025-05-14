<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function sales() {
        return $this->hasMany(CarSale::class);
    }
    
}
