<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::get('reset/{email}','AuthController@sendResetPasswordEmail');
});
Route::prefix('product')->group(function () {
    Route::get('', 'ProductController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::get('my-products', 'ProductController@myProducts');
        Route::post('', 'ProductController@create');
        Route::put('{id}', 'ProductController@update');
        Route::delete('{id}', 'ProductController@delete');

    });
});
Route::prefix('category')->group(function () {
    Route::get('', 'CategoryController@getAll');
    Route::get('{id}', 'CategoryController@getOne');
    Route::post('', 'CategoryController@create');
});
