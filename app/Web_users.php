<?php


namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class Web_users extends Authenticatable{
	
	use Notifiable;

	protected $table = 'web_users';

	protected $guard = 'web_users';


	protected $fillable = [
		'name', 'email','mobile', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];


}