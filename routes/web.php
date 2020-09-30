<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('welcome');
})->middleware("auth");

Route::get('/', "LoginController@index")->middleware("guest");
Route::post("login", "LoginController@login");

Route::get("/category", "CategoryController@index")->name("category");
Route::post("category/store", "CategoryController@store");
Route::get("/category/fetch/{page}", "CategoryController@fetch");
Route::post("/category/update", "CategoryController@update");
Route::post("/category/delete", "CategoryController@delete");

Route::get("/size", "SizeController@index")->name("size");
Route::post("/size/store", "SizeController@store");
Route::get("/size/fetch/{page}", "SizeController@fetch");
Route::post("/size/update", "SizeController@update");
Route::post("/size/delete", "SizeController@delete");

Route::get("/format", "FormatController@index")->name("format");
Route::post("format/store", "FormatController@store");
Route::get("/format/fetch/{page}", "FormatController@fetch");
Route::post("/format/update", "FormatController@update");
Route::post("/format/delete", "FormatController@delete");
