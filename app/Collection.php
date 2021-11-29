<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model{
    
    protected $table = 'collections';

    protected $guarded = ['id'];

    protected $fillable = [];
}