<?php

Route::get('/', 'PageController@welcome');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');

/* Books */
Route::get('/books', 'BookController@index');
Route::get('/books/{title}', 'BookController@show');

/* Practice | any responds to any of the HTTP methods */
Route::any('/practice/{n?}', 'PracticeController@index');