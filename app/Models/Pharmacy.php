<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        //create
        static::updated(function ($pharmacy){
            $owner = User::find($pharmacy->owner_id);
            if ($owner == null) {
                throw new \Exception("Owner not found");
            }
            $owner->pharmacy_id = $pharmacy->id;
            $owner->save();
            // dd($owner);
            // die("Update ...........".$pharmacy->owner_id);
        });

         //create
         static::created(function ($pharmacy){
            $owner = User::find($pharmacy->owner_id);
            if ($owner == null) {
                throw new \Exception("Owner not found");
            }
            $owner->pharmacy_id = $pharmacy->id;
            $owner->save();
        });
    }
}
