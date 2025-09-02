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

    protected $fillable = ['trip_date','vendor_id','vehicle_type_category','vehicle_no','origin','destination','vehicle_type_id','client_id','driver_id','remark','rate','unique_no','pod_no', 'pod_document', 'pod_date', 'courier','courier_date', 'courier_tracking_number','pod_status','courier_status'];

            public function vendor()
            {
                return $this->belongsTo(Vendormaster::class, 'vendor_id');
            }

            public function vehicle()
            {
                return $this->belongsTo(VehicleTypeMaster::class, 'vehicle_type_id');
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
