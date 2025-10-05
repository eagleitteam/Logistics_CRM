<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Invoicemaster extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['inv_no', 'inv_date','client_id','year_id','template_id','trip_total','net_total','gstMaster_id','igst_percent','igst_amt','cgst_percent','cgst_amt','sgst_percent','sgst_amt','gst_amount','total_amount','bank_id','termsconditionmaster_id',];

        
        // App\Models\Invoicemaster.php
        public function trips()
        {
            return $this->hasMany(Invoiceadhoctripdata::class, 'invoice_master_id', 'id')->with('tripMovement');
        }


        public function client()
            {
                return $this->belongsTo(Clientmaster::class, 'client_id');
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
