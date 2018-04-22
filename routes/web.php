<?php

Route::get('/', 'PageController@welcome');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');

# Show all books
Route::get('/books', 'BookController@index');

# Search for a book
Route::get('/books/search', 'BookController@search');

# Show a book
Route::get('/books/{id}', 'BookController@show');

# Practice
Route::any('/practice/{n?}', 'PracticeController@index');

# Trivia
Route::get('/trivia', 'TriviaController@index');
Route::get('/trivia/result', 'TriviaController@result');

# Debug code
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: ' . $e->getMessage();
    }

    dump($debug);
});

# Add a book
Route::get('/books/create', 'BookController@create');
Route::post('/books', 'BookController@store');

# Edit a book
Route::get('/books/{id}/edit', 'BookController@edit');
Route::put('/books/{id}', 'BookController@update');

# Delete a book
Route::get('/books/{id}/delete', 'BookController@delete');
Route::delete('/books/{id}', 'BookController@destroy');