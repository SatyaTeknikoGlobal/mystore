<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model{
    
    protected $table = 'coupan';

    protected $guarded = ['id'];

    protected $fillable = [];
}