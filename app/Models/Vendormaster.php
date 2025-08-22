<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use App\Models\MasterGroupCategory;
use App\Models\Statemaster;

class Vendormaster extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['vendor_name','vendor_address','gst_status','gst_no','tds_applicable','tds_rate','contact_name','contact_no','alternate_contact_no','email','city','pincode','state',
        'cccc','master_id','group_id','subgroup_id','opening_amt','dr_cr','year_master','status'];

public function MasterGroupCategory()
        {
        return $this->belongsTo(MasterGroupCategory::class, 'master_group_category_id', 'id');
        }
public function states()
        {
        return $this->belongsTo(Statemaster::class, 'state', 'id');
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
