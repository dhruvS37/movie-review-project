<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieCastMapping extends Model
{
    protected $table = "movie_cast_mapping";
    public $timestamps = false;

    protected $guarded = ['id'];
}
