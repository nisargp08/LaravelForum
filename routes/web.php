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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/threads','ThreadsController@index')->name('threads.index');
Route::get('/threads/{thread}','ThreadsController@show');
Route::post('/threads','ThreadsController@store');
Route::post('/threads/{thread}/replies','RepliesController@store');


Route::get('/home', 'HomeController@index')->name('home');
