<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Courier extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'courier';

    protected $fillable = [
       'branch_id', 'name', 'image', 'phone', 'email', 'password', 'vehicle', 'plate', 'color', 'status',
    ];

    protected $hidden = [
        'password',
    ];

}
