<?php 

Route::get('/', 'UploadController@index');
Route::post('/upload', 'UploadController@upload');

Route::any('/', 'ErrorController@notFoud');
