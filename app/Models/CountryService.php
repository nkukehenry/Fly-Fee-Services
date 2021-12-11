<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'services_form' => 'object'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

}
