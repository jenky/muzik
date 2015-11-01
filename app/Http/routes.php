<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

require app_path('Http/api_routes.php');

Route::any('/{one?}/{two?}/{three?}/{for?}/{five?}', function() {
    
    // if (! is_null(app('debugbar'))) {
    //     app('debugbar')->disable();
    // }

    return view('app');
});

Route::get('/', function () {
    return view('welcome');
});
