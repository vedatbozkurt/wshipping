<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
       'name',
    ];

    public $timestamps = false;

    function district() {
        return $this->hasMany('App\District');
    }

    function branch() { //birçok şubeye ait olabilir
        return $this->belongsToMany('App\Branch');
    }

    function courier() { //birçok kuryeye ait olabilir
        return $this->belongsToMany('App\Courier');
    }



}
