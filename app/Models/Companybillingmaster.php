<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Companybillingmaster extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['company_name', 'company_type','pan_number','proprietor_name','gststatus','gstno','revscharge','address_line1','address_line2','city','state','pin_code','contact_number','email','website','Bank_id','gst_code_id','company_logo','company_seal','authorised_signature'];

            public function bank()
            {
                return $this->belongsTo(\App\Models\Bankmaster::class, 'Bank_id');
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
