<?php

Route::view('/', 'root');
Route::get('/qrsheets/download', 'QrSheetController@downloadPDF')->name('qrsheets.download'); 

