<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Drivermaster;
use App\Models\Clientmaster;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicle;
use App\Models\Vendormaster;

class TripMovement extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['trip_date','vendor_id','vehicle_no','origin','destination','vehicle_id','client_id','driver_id','per_day_allow','remark','rate'];

            public function vendor()
            {
                return $this->belongsTo(Vendormaster::class, 'vendor_id');
            }

            public function vehicle()
            {
                return $this->belongsTo(VehicleTypeMaster::class, 'vehicle_id');
            }
            
            public function client()
            {
                return $this->belongsTo(Clientmaster::class, 'client_id');
            }
            public function driver()
            {
                return $this->belongsTo(Drivermaster::class, 'driver_id');
            }

            public function VehicalNumber()
            {
                return $this->belongsTo(SelfVehicle::class, 'vehicle_no');
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
