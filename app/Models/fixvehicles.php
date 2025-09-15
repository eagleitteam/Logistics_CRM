<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\fixvehicleclients;

class fixvehicles extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['fixvehicleclients_id','clientmaster_id','self_vehicle_id','vehical_type','fixed_km','fixed_price','extra_km_rate'];

    // प्रत्येक vehicle एका client contract शी belong करतं
    public function fixvehicleclient()
    {
        return $this->belongsTo(FixVehicleClient::class, 'fixvehicleclients_id', 'id');
    }


    public static function booted()
    {
        static::created(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
