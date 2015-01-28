<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@homePage'); 
Route::get('/users', 'UserController@index');
Route::get('/users/register', 'UserController@showRegister');
Route::post('/users/register', 'UserController@doRegister');
Route::get('/users/edit/','UserController@edit'); 
Route::get('/users/show/{username}','UserController@show');
Route::post('/users/update/','UserController@update');
Route::post('/login', 'UserController@login'); 
Route::get('/logout', 'UserController@logout'); 
