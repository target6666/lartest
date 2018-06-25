<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children(){
        return $this->hasMany('App\Category', 'parent_id', 'id')
            ->with(['children' => function($query){
                $query->select('id', 'name', 'parent_id', 'parent_id', 'artno_min');
            }]); ;
    }
    
    public function parent(){
        return $this->belongsTo('App\Category', 'parent_id')
            ->with(['parent' => function($query){
                $query->select('id', 'name', 'parent_id', 'artno_min', 'artno_max');
            }]);
    }

    public function articles(){
        return $this->hasMany('App\Article', 'category_id', 'id');
    }

}
