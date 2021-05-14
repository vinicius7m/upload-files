<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('upload', ['as' => 'files.upload', 'uses' => 'HomeController@upload']);
Route::get('user/{userId}/download/{documentId}', ['as' => 'files.download', 'uses' => 'HomeController@download']);
Route::get('user/{userId}/remove/{documentId}', ['as' => 'files.destroy', 'uses' => 'HomeController@destroy']);

Route::auth();

Route::get('/home', 'HomeController@index');
