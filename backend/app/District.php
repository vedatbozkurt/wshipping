<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
       'name', 'city_id',
    ];

    function city() {
        return $this->belongsTo('App\City');
    }

    function address() {
        return $this->belongsTo('App\Address');
    }

    function branch() {
        return $this->belongsTo('App\Branch');
    }
}
