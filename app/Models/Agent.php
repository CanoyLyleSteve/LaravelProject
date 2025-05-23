<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function sales() {
        return $this->hasMany(CarSale::class);
    }
    
}

