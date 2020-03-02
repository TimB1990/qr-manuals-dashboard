<?php

Route::get('/', function () {
    return view('welcome');
});

// POST
Route::post('/products/{id}/manuals', 'ManualsController@store');

// DELETE
Route::delete('/products/{id}/manuals/{manual_id}', 'ManualsController@destroy')->name('products.manuals.destroy');

// GET
Route::get('/products', 'ProductController@index');
Route::get('/products/{id}/details', 'ProductDetailsController@show');
Route::get('/products/{id}/manuals', 'ManualsController@index');
Route::get('/products/{id}/manuals/{manual_id}', 'ManualsController@show')->name('products.manuals.show');



// download uri
// by: $manual->file_url = route('products.manuals.show', [$product->id, $manual->id]); values of {id} and {manual_id} are initialized
