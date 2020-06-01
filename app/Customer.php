<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   protected $fillable = ['name','email','address','telephone','mobile'];

    public function packages()
    {
        return $this->belongsToMany(Package::class);
   }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%');
    }
}
