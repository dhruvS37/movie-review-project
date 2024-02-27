<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieCategoryMapping extends Model
{

    protected $table = "movie_category_mapping";
    public $timestamps = false;

    protected $guarded = ['id'];
}
