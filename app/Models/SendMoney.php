<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendMoney extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        'user_information' => 'object',
        'paid_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    protected $appends = ['totalPay','totalBaseAmountPay'];


    public function getTotalPayAttribute()
    {
        return $this->payable_amount -  (float) $this->discount;
    }

    public function getTotalBaseAmountPayAttribute()
    {
       return (($this->totalPay / $this->send_curr_rate)* config('basic.rate')) ;
//       return (($this->totalPay)??1 / ($this->send_curr_rate) ??1) * config('basic.rate');
    }



    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function sendCurrency()
    {
        return $this->belongsTo(Country::class,'send_currency_id','id');
    }
    public function getCurrency()
    {
        return $this->belongsTo(Country::class,'receive_currency_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
    public function provider()
    {
        return $this->belongsTo(CountryService::class,'country_service_id','id');
    }

    public function payment()
    {
        return $this->hasOne(Fund::class,'send_money_id','id')->where('status','!=',0);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id','id');
    }



}
