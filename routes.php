<?php 

/*
 * Used for entry and upload
 */
Route::get('/', 'UploadController@index');
Route::post('/upload', 'UploadController@upload');

/*
 * When User use stranged route
 * Redirect to home
 */
Route::any('/', 'ErrorController@notFoud');
