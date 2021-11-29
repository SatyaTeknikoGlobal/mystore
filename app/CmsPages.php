<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPages extends Model{
    
    protected $table = 'cms_pages';

    protected $guarded = ['id'];

    protected $fillable = [];

    public function children(){
        return $this->hasMany('App\CmsPages', 'parent_id');
    }
}