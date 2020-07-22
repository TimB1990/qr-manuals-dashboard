<?php

Route::view('/', 'root');
Route::get('/qrsheets/download', 'QrSheetController@downloadPDF')->name('qrsheets.download'); 
Route::get('/products/{artnr}', 'ProductController@showByArtnr');
Route::put('/quotations/{id}/{token}', 'QuoteController@updateByCustomer');

