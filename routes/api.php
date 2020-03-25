<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::get('/products', 'ProductController@index');
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
