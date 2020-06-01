<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillabe = ['customer_id','payment_id','amount_due','amount_payed','due_date'];

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
