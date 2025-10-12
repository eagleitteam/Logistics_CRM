<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fuel extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'date',
        'current_km',
        'fuel_qty',
        'fuel_rate',
        'fuel_amt',
        'payment_method',
        'distance',
        'avg',
        'driver_name',
        'note'
    ];
}
