<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleTypeMaster;

class SelfVehicle extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['vehicle_type_master_id', 'fule_type','register_date',
    'vehicle_number','chassis_num','eng_num','model_num','toll_stm','remark','type','vendor_name','capacity','status'];

    public function vehicleType()
        {
            return $this->belongsTo(VehicleTypeMaster::class, 'vehicle_type_master_id', 'id');
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
