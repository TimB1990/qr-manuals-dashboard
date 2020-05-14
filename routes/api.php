<?php

use Illuminate\Http\Request;

// Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');

Route::post('/send-token', 'Api\AuthController@sendToken');
Route::post('/validate-token', 'Api\AuthController@validateToken');
Route::post('/reset-password', 'Api\AuthController@resetPassword');

Route::get('/products', 'ProductController@index');
Route::get('/products/{artnr}', 'ProductController@showByArtnr');

Route::get('/products/{id}/details', 'ProductDetailsController@show');
Route::get('/products/{id}/manuals', 'ManualsController@index');
Route::get('/products/{id}/manuals/{manual_id}', 'ManualsController@show')->name('products.manuals.show');

Route::group(['middleware' => 'auth:api'], function(){

    // UPLOAD
    Route::post('/products/{id}/manuals', 'ManualsController@store');
    Route::post('/quotations/{id}/specification');
    // DELETE
    Route::delete('/products/{id}/manuals/{manual_id}', 'ManualsController@destroy')->name('products.manuals.destroy');
    // GET quotes
    Route::get('/quotations', 'QuoteController@index');
    Route::get('/quotations/{id}', 'QuoteController@show');
    Route::put('/quotations/{id}', 'QuoteController@update');
});

// quotations
Route::post('/quotations', 'QuoteController@store');
// Route::put('/quotations/{customer_token}/{id}')


