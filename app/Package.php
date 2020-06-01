<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name','description'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function packageDetails()
    {
        return $this->hasOne(PackageDetail::class);
    }
}
