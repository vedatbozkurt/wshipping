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

    function address() { //ilçe birçok adrese sahip olabilir(usera adres detayları gösterilirken kullanılabilir)
        return $this->hasMany('App\Address');
    }

    public function tasks(){ //tasklar hangi şubenin ilçesinden gönderildiyse o şubeye gösterilir
        return $this->hasManyThrough('App\Task', 'App\Address','district_id', 'sender_address_id', 'id');
    }
    public function users(){//userlar hangi şubenin ilçesiyle adres kaydetmişse o ilçeden sorumlu şubeye gösterilir
        return $this->hasManyThrough('App\User', 'App\Address','district_id', 'id', 'id','user_id' )->distinct();
    }
}
