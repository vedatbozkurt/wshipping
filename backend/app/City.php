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

    function branch() {
        return $this->belongsToMany('App\Branch');
    }

}
