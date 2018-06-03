<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }
    
    public function parent(){
        return $this->hasOne('App\Category', 'id', 'parent_id');
    }

    public function articles(){
        return $this->hasMany('App\Article', 'category_id', 'id');
    }
    
}
