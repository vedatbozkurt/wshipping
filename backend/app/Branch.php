<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-06-16 17:52:20
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-06-16 18:00:14
 */
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Branch extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'branch';

    protected $fillable = [
        'city_id', 'district_id', 'name', 'phone', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    function courier() {
        return $this->hasMany('App\Courier');
    }
}
