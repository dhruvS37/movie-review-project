<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $filterData = $this->filterQuery();

        return view('filter', ['categories' => $categories, 'data' => $filterData]);
    }
    
    public function filterData(Request $request)
    {
        $filters = $request->query();
        $result = $this->filterQuery($filters);

        return $result;
    }

    public function filterQuery($filters = [])
    {

        $filterResult = Movie::movieInfo(['category', 'cast'])
            ->where('movies.status', '=', '1')
            ->distinct('categories.category', 'cast_crew.cast_name');

        if (!empty($filters)) {

            if (array_key_exists('categories', $filters)) {
                $filteredMovieOnCategory = Movie::leftjoin('movie_category_mapping', function ($join) {

                    $join->on('movies.id', '=', 'movie_category_mapping.movie_id')->where('movie_category_mapping.status', '1');
                })->join('categories', function ($join) use ($filters) {
                    $join->on('categories.id', '=', 'movie_category_mapping.category_id')->whereIn('categories.category', $filters['categories'])->where('categories.status', '1');
                })->pluck('movies.id')->toArray();
 
                $filterResult->whereIn('movies.id', $filteredMovieOnCategory);
            }
            if (array_key_exists('ratings', $filters))
                $filterResult->whereIn('movies.rating', $filters['ratings']);

            if (array_key_exists('sort', $filters)){
                return $filterResult->orderBy('movies.movie_name', $filters['sort'])->get();
            }
                
        }
        return $filterResult->orderBy('movies.movie_name', 'asc')->get();
    }
}
