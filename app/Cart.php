<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model{
    
    protected $table = 'carts';

    protected $guarded = ['id'];

    protected $fillable = [];
}