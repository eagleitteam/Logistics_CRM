<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\fixvehicles;
use App\Models\Clientmaster;



class fixvehicleclients extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['clientmaster_id','start_date','end_date'];

    // एक client ला अनेक vehicles असतात
    public function fixvehicles()
    {
        return $this->hasMany(fixvehicles::class, 'fixvehicleclients_id', 'id');
    }

    public function client()
    {
        return $this->hasOne(Clientmaster::class, 'id', 'clientmaster_id');
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
