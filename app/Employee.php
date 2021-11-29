<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;
class Employee extends Authenticatable {

use Notifiable;

protected $guard = 'employee';

protected $fillable = [
    'name', 'username', 'password',
];

protected $hidden = [
    'password', 'remember_token',
]; }