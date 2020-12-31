<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $guard = 'courier';

    protected $fillable = [
       'name', 'image', 'phone', 'email', 'password', 'vehicle', 'plate', 'color', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    function city() { //kurye birden fazla ilde çalışabilir
        return $this->belongsToMany('App\City');
    }

    function district() { //kurye birden fazla ilçede çalışabilir
        return $this->belongsToMany('App\District');
    }

    function task() { //kurye birçok gönderiye sahip olabilir
        return $this->hasMany('App\Task');
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('id', 'like', '%'.$s.'%')
        ->orwhere('name', 'like', '%'.$s.'%')
        ->orwhere('phone', 'like', '%'.$s.'%')
        ->orwhere('vehicle', 'like', '%'.$s.'%')
        ->orwhere('plate', 'like', '%'.$s.'%')
        ->orwhere('email', 'like', '%'.$s.'%');
    }
}
