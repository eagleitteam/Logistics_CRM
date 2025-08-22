<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Drivermaster extends BaseModel
{
    use HasFactory, SoftDeletes;

        protected $fillable = [
        'first_name','last_name','mobile_no','basic_salary','joining_date','resigning_date','alternate_contact_no','email','address','city','pincode','state','status','aadhar_card_path','pan_card_path','driving_license_path','driving_license_validity','remark','bank_name','bank_account_no','ifsc_code','upi_reference_name','bank_branch','upi_number',
        'categories','master_id','group_id','subgroup_id',
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
