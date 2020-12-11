<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'phone', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function address() { //müsteri birçok adrese sahip olabilir
        return $this->hasMany('App\Address');
    }

    function tasksender() { //gönderen user birçok gönderiye sahip olabilir
        return $this->hasMany('App\Task', 'sender_id', 'id');
    }

    function taskreceiver() { //alıcı user birçok gönderiye sahip olabilir
        return $this->hasMany('App\Task', 'receiver_id', 'id');
    }
}
