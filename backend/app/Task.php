<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'courier_id', 'sender_id', 'receiver_id', 'sender_address_id', 'receiver_address_id', 'price', 'description', 'status',
    ];

    function courier() { //gönderi bir kuryeye ait olabilir
        return $this->belongsTo('App\Courier');
    }

    function sender() { //gönderi bir kuryeye ait olabilir
       return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    function receiver() { //gönderi bir kuryeye ait olabilir
       return $this->belongsTo('App\User', 'receiver_id', 'id');
    }

    function senderaddress() { //gönderi bir gönderici adrese ait olabilir
       return $this->belongsTo('App\Address', 'sender_address_id', 'id');
    }

    function receiveraddress() { //gönderi bir alıcı adrese ait olabilir
       return $this->belongsTo('App\Address', 'receiver_address_id', 'id');
    }

}
