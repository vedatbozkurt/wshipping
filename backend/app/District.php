<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
       'name', 'city_id',
    ];

    public $timestamps = false;

    function city() {
        return $this->belongsTo('App\City');
    }

    function branch() {  //birçok şubeye ait olabilir
        return $this->belongsToMany('App\Branch');
    }

    function courier() { //birçok kuryeye ait olabilir
        return $this->belongsToMany('App\Courier');
    }

    function address() { //müsteri birçok adrese sahip olabilir
        return $this->hasMany('App\Address');
    }
}
