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

    function address() { //il birçok adrese sahip olabilir(usera adres detayları gösterilirken kullanılabilir)
        return $this->hasMany('App\Address');
    }

    public function tasks(){ //tasklar hangi şubenin ilinden gönderildiyse o şubeye gösterilir
        //city_id: address tablosundan, sender_address_id: task tablosundan, id: city tablosundan
        return $this->hasManyThrough('App\Task', 'App\Address','city_id', 'sender_address_id', 'id');
    }
    public function users(){
        //normal işleyişte 3. tabloda 2. sıradaki tablonun bilgisi olur
        //bu durumda 2. tabloda 3.tablonun bilgisi bulunuyor
        //city_id: address--id:user--id:city--user_id:address
        return $this->hasManyThrough('App\User', 'App\Address','city_id', 'id', 'id','user_id')->distinct()->orderBy('id', 'desc');
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('id', 'like', '%'.$s.'%')
        ->orwhere('name', 'like', '%'.$s.'%');
    }
}
