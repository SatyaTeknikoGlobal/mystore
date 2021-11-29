<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable{

    protected $table = 'users';

    protected $guarded = ['id'];
    

    protected $fillable = [];


    public function userAddresses(){
        return $this->hasMany('App\UserAddress', 'user_id');
    }


    public function userWishlist(){
        return $this->hasMany('App\UserWishlist', 'user_id');
    }

    public function wishlistProducts(){
        return $this->belongsToMany('App\Product', 'user_wishlist', 'user_id')->withPivot('user_id', 'product_id', 'size_id');
    }


    public function userState(){
        return $this->belongsTo('App\State', 'state');
    }

    public function userCity(){
        return $this->belongsTo('App\City', 'city');
    }

    public function userCountry(){
        return $this->belongsTo('App\Country', 'country');
    }

    public function userWallet(){
        return $this->hasMany('App\UserWallet');
    }


}