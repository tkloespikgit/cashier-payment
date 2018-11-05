<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table='admin';
    protected $fillable = [
        'name', 'account', 'email', 'email_status', 'phone', 'phone_country', 'phone_status', 'password', 'secret_token' ,'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
