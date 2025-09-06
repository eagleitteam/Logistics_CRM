<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Clientmaster extends BaseModel
{
    use HasFactory, SoftDeletes;



        protected $fillable = [
        'client_name','gst_status','gst_no','contact_name','contact_no','alternate_contact_no','email','billing_address','city','pincode','state','billing_type',
        'billing_date','categories','master_id','group_id','subgroup_id','opening_amt','dr_cr','year_master','status',
        'updated_by',
        'deleted_by',
        ];

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
