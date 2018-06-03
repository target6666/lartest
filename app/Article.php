<?php

namespace App;

use Http\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo('App\Category')->withDefault();
    }

    public function scopeApplyFilter($query, $filter)
    {
        $query=$query->where(function ($query) use ($filter){
                $query=$query->Where('name', 'like', '%'.$filter.'%')
                            ->orWhere('artno', 'like', '%'.$filter.'%');
            
        });
    }
}
