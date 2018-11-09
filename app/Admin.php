<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class Admin extends Authenticatable
{
    use EntrustUserTrait,Notifiable;

    protected $table='admins';

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
