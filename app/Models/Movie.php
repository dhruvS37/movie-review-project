<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function scopeMovieInfo(Builder $query, $colums = [])
    {
        $query->leftjoin('movie_category_mapping', function ($join) {
            $join->on('movies.id', '=', 'movie_category_mapping.movie_id')->where('movie_category_mapping.status', '1');
        })
            ->leftjoin('categories', function ($join) {
                $join->on('categories.id', '=', 'movie_category_mapping.category_id')->where('categories.status', '1');
            })
            ->leftjoin('movie_cast_mapping', function ($join) {
                $join->on('movies.id', '=', 'movie_cast_mapping.movie_id')->where('movie_cast_mapping.status', '1');
            })
            ->leftjoin('cast_and_crew', function ($join) {
                $join->on('movie_cast_mapping.cast_id', '=', 'cast_and_crew.id')->where('cast_and_crew.status', '1');
            })->select('movies.id', 'movies.movie_name', 'movies.rating');


        if (!empty($colums)) {


            if (in_array('category', $colums)) {
                $query->addSelect(DB::raw('GROUP_CONCAT(DISTINCT categories.category) AS categories'));
            }
            if (in_array('cast', $colums)) {
                $query->addSelect(DB::raw('GROUP_CONCAT(DISTINCT cast_and_crew.cast_name) AS cast_crew'));
            }

            $query->groupBy('id');
        }
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'movie_category_mapping')->withPivot('status')->wherePivot('status',1);
    }
    public function casts()
    {
        return $this->belongsToMany('App\Models\Cast', 'movie_cast_mapping')->withPivot('status')->wherePivot('status',1);
    }
}
