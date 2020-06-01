<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    protected $fillable = ['package_id','total_price','monthly_price','down_payment','payment_duration'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
