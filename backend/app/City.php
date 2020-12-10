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

    function branch() { //birçok şubeye ait olabilir
        return $this->belongsToMany('App\Branch');
    }

    function courier() { //birçok kuryeye ait olabilir
        return $this->belongsToMany('App\Courier');
    }

    function address() { //müsteri birçok adrese sahip olabilir
        return $this->hasMany('App\Address');
    }

}
