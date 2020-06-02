<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['customer_id','amount_left','amount_paid','defaulted_amount','defaulted'];

    protected $casts = ['due_date'];

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function packagedetails()
    {
        return $this->belongsTo(PackageDetail::class);
    }

}
