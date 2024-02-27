<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Category;
use App\Models\Movie;
use App\Models\MovieCastMapping;
use App\Models\MovieCategoryMapping;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $casts = Cast::all();
        $movie = Movie::movieInfo(['category', 'cast'])
            ->where('movies.status', '=', '1')
            ->distinct('categories.category', 'cast_crew.cast_name')
            ->orderBy('movies.id', 'desc')
            ->get();

        return view('home', ['categories' => $categories, 'casts' => $casts, 'movies' => $movie]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'movieName' => 'required|max:50',
            'rating' => 'required|between:0,5'
        ]);

        $postData = $request->all();

        $movie = new Movie;
        $movie->movie_name = $postData['movieName'];
        $movie->rating = $postData['rating'];

        if ($movie->save()) {
            $movieId = $movie->id;

            foreach ($postData['category'] as $category) {
                $categoryId = Category::select('id')->where('category', "$category")->get();
                MovieCategoryMapping::create(['movie_id' => $movieId, 'category_id' => $categoryId[0]->id]);
            }
            foreach ($postData['castAndCrew'] as $cast) {
                $castId = Cast::select('id')->where('cast_name', "$cast")->get();
                MovieCastMapping::create(['movie_id' => $movieId, 'cast_id' => $castId[0]->id]);
            }

            return redirect('home')->with('success_massage', 'Operation completed successfully');
        } else
            return redirect('home')->with('error_massage', 'An error ocuurs. Please try again!');
    }


    public function show($id)
    {

        $movie = Movie::movieInfo(array('category', 'cast'))
            ->where('movies.status', '=', '1')
            ->where('movies.id', '=', $id)
            ->distinct('categories.category', 'cast_crew.cast_name')
            ->orderBy('movies.id', 'desc')
            ->get();

        return redirect('home')->with('dataToUpdate', $movie);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'movieName' => 'required|max:50',
            'rating' => 'required|between:0,5'
        ]);
        
        $putData = $request->all();

        $movieModel = Movie::find($id);
        $movieModel->movie_name = $putData['movieName'];
        $movieModel->rating = $putData['rating'];


        if ($movieModel->save()) {
            $categoriesId = Category::whereIn('category', $putData['category'])->pluck('id')->toArray();

            $categoryMappingEntries = [];
            foreach ($categoriesId as $cId) {

                $categoryMappingId = MovieCategoryMapping::updateOrCreate(['movie_id' => $id, 'category_id' => $cId], ['status' => 1]);

                array_push($categoryMappingEntries, $categoryMappingId->id);
            }
            MovieCategoryMapping::where('movie_id', $id)->whereNotIn('id', $categoryMappingEntries)->update(['status' => 0]);


            $castId = Cast::whereIn('cast_name', $putData['castAndCrew'])->pluck('id')->toArray();

            $castMappingEntries = [];
            foreach ($castId as $cId) {

                $castMappingId = MovieCastMapping::updateOrCreate(['movie_id' => $id, 'cast_id' => $cId], ['status' => 1]);

                array_push($castMappingEntries, $castMappingId->id);
            }
            MovieCastMapping::where('movie_id', $id)->whereNotIn('id', $castMappingEntries)->update(['status' => 0]);

            return redirect('home')->with('success_massage', 'Operation completed successfully');
        } else
            return redirect('home')->with('error_massage', 'An error ocuurs. Please try again!');
    }


    public function destroy(Request $request, $id)
    {
        $movieModel = Movie::find($id);
        $movieModel->status = 0;

        if ($movieModel->save()) {

            $removeCategoryMap = MovieCategoryMapping::where('movie_id', $id)->update(['status' => 0]);
            $removeCastMap = MovieCastMapping::where('movie_id', $id)->update(['status' => 0]);
            $request->session()->flash('success_massage', 'Operation completed successfully');

            return ['status' => 200, 'message' => "Operation completed successfully"];
        } else {
            $request->session()->flash('error_massage', 'An error ocuurs. Please try again!');

            return ['status' => 500, 'message' => "Eroor"];
        }
    }
}
