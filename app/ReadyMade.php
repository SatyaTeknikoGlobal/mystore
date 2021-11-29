<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadyMade extends Model{
    
    protected $table = 'readymade_products';

    protected $guarded = ['id'];

    protected $fillable = [];
}