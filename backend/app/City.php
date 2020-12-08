<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
       'name',
    ];

    function district() {
        return $this->hasMany('App\District');
    }

    function address() {
        return $this->belongsTo('App\Address');
    }

    function branch() {
        return $this->belongsTo('App\Branch');
    }

}
