<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
       'user_id', 'city_id', 'district_id', 'name', 'description',
    ];

    function city() { //adres bir ile ait olabilir
        return $this->belongsTo('App\City');
    }

    function district() { //adres bir ilçeye ait olabilir
        return $this->belongsTo('App\District');
    }

    function user() { //adres bir kullanıcıya ait olabilir
        return $this->belongsTo('App\User');
    }

    function tasksenderaddress() { //gönderen userın adresi birçok gönderiye sahip olabilir
        return $this->hasMany('App\Task', 'sender_address_id', 'id');
    }

    function taskreceiveraddress() { //alıcı userın adresi birçok gönderiye sahip olabilir
        return $this->hasMany('App\Task', 'receiver_address_id', 'id');
    }
}
