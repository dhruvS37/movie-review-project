<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home','HomeController@show');

Route::get('/category', function () {
    return view('category');
});
Route::post('/category', 'CategoryController@insertCategory');

Route::get('/cast', function () {
    return view('cast');
});
Route::post('/cast','CastController@insertCast');

// Route::post('/',)
Route::resource('/home', 'MovieController',['exept'=>['home.create','home.edit']]);

Route::get('/relation','CategoryController@show');