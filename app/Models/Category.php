<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   

    protected $table = "categories";
    public $timestamps = false;
    protected $guarded = ['id'];
    
    public function movies(){
        return $this->belongsToMany('App\Models\Movie','movie_category_mapping')->withPivot('status')->wherePivot('status',1);
    }
}
