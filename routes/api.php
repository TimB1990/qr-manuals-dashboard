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
    // DELETE
    Route::delete('/products/{id}/manuals/{manual_id}', 'ManualsController@destroy')->name('products.manuals.destroy');
});

// quotations
Route::post('/products/{id}/quotations', 'QuoteController@store');
Route::put('/products/{id}/reservation'.'ProductReservationController@store');


