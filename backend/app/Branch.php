<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-06-16 17:52:20
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-06-29 04:54:05
 */
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $guard = 'branch';

    protected $fillable = [
        'name', 'phone', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    function city() { //şubeye ait birçok il olabilir
        return $this->belongsToMany('App\City');
    }

    function district() { //şubeye ait birçok ilçe olabilir
        return $this->belongsToMany('App\District');
    }

}
