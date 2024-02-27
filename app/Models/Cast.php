<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    //
    protected $table = "cast_and_crew";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function movies(){
        return $this->belongsToMany('App\Models\Movie','movie_cast_mapping')->withPivot('status')->wherePivot('status',1);
    }
}
