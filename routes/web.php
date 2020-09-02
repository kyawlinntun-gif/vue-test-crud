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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Vue route for laravel
Route::get('/', 'HomeController@index');
Route::get('/user/create', 'HomeController@index');
Route::get('/user/show/{id}', 'HomeController@index');

// Vue route
// Route::get('{path}', 'HomeController@index')->where('path', '([a-zA-Z\-\_]+)?');

// Vue route for user
Route::get('/user', 'UserController@index');
Route::post('/user', 'UserController@store');
Route::get('/user/{id}', 'UserController@edit');
Route::match(['put', 'patch'], '/user', 'UserController@update');
Route::delete('/user/{id}', 'UserController@destroy');

