<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
       'name',
    ];


    function user() {
        return $this->belongsTo('App\User');
    }

    function city() {
        return $this->hasOne('App\City');
    }

    function district() {
        return $this->hasOne('App\District');
    }
}
