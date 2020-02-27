<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/products/{id}/uploads', 'UploadsController@store');
// Route::get('/pdf-files', 'UploadsController@index');

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}/details', 'ProductDetailsController@show');
Route::get('/products/{id}/manuals', 'ManualsController@show');

Route::get('/products/{filename}', 'UploadsController@download');

// Route::get('/products')

/*Route::group(['middleware' => 'auth'], function () {
    Route::get('files', 'FileEntriesController@index');
});*/