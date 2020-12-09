<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-06-16 17:52:20
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-06-18 17:45:38
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
        'city_id', 'district_id', 'name', 'phone', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    function city() {
        return $this->belongsToMany('App\City');
    }

    function district() {
        return $this->belongsToMany('App\District');
    }


}
