<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    
    protected $table = 'coupan_catagory';

    protected $guarded = ['id'];

    protected $fillable = [];
}