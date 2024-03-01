<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $category = Movie::find(56)->categories()->wherePivot('status',1)->pluck('category');
        $movie = Category::find(1)->movies;
        $cast = Movie::find(56)->casts;

        // $movie = Movie::find(56);
        // $category = Category::where('category','Romantic')->value('id');
        // $movie->categories()->attach($category);


        return $cast;
        return $movie;
        return implode(',',$category->toArray());
        return $category;
    }

    public function showInsertCategoryForm(){
        return view('category');
    }
    
    public function insertCategory(Request $request){
        $category = new Category;
        
        $category->category = $request->input('category');
        
        if( $category->save())
            return redirect('category')->with('success_massage', 'Operation completed successfully');
        else
            return redirect('category')->with('error_massage', 'An error ocuurs. Please try again!');
    }
}

