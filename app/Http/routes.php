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

Route::any('/{one?}/{two?}/{three?}/{for?}/{five?}', function() {
    
    // if (! is_null(app('debugbar'))) {
    //     app('debugbar')->disable();
    // }

    return view('app');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| 
| Register all routes for API system.
| 
*/

$api = app(Dingo\Api\Routing\Router::class);

$middleware = ['cors'];
if (! is_null(app('debugbar'))) {
    $middleware[] = 'Barryvdh\Debugbar\Middleware\Debugbar';
}

$api->version('v1', ['middleware' => $middleware], function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\API\v1'], function ($api) {
        $api->resources([
            'users'   => 'UsersController',
            'tracks'  => 'TracksController',
            'artists' => 'ArtistsController',
        ]);
    });
});
