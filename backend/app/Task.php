<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
       'courier_id', 'sender_id', 'receiver_id', 'sender_address_id', 'receiver_address_id', 'price', 'description', 'status',
    ];

    function courier() { //gönderi bir kuryeye ait olabilir
        return $this->belongsTo('App\Courier');
    }

    function sender() { //gönderi bir kuryeye ait olabilir
       return $this->belongsTo('App\User', 'id', 'sender_id');
    }

    function receiver() { //gönderi bir kuryeye ait olabilir
       return $this->belongsTo('App\User', 'id', 'receiver_id');
    }

    function senderaddress() { //gönderi bir gönderici adrese ait olabilir
       return $this->belongsTo('App\Address', 'id', 'sender_address_id');
    }

    function receiveraddress() { //gönderi bir alıcı adrese ait olabilir
       return $this->belongsTo('App\Address', 'id', 'receiver_address_id');
    }

}
