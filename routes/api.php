<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});
Route::prefix('auth')->group(function(){
    Route::post('signup','AuthController@signup');
    Route::post('login','AuthController@login');
});
Route::prefix('product')->group(function ()
{
    Route::get('', 'ProductController@getAll');
    Route::post('', 'ProductController@create');
    Route::put('{id}', 'ProductController@update');
    Route::delete('{id}', 'ProductController@delete');
});
Route::prefix('category')->group(function ()
{
    Route::post('','CategoryController@create');
});
