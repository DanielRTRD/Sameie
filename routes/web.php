<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| DEBUG ONLY
*/
if (Config::get('app.debug')) {
    Route::get('/resetdb', function () {
        \Session::forget('laravel_session');
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        return redirect('/login')->with('status', 'DB has been reset.');
    });
    Route::get('/test', function () {
        App::abort(404);
    });
}
/*
| END DEBUG ONLY
*/

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('dashboard')->middleware('verified');

//Route::resource('c', 'CondoController');

Route::group(
    [
        'prefix' => 'c'
    ],
    function () {
        Route::get('/', [
            'as' => 'c-index',
            'uses' => 'CondoController@index'
        ]);
        Route::get('/opprett', [
            'as' => 'c-create',
            'uses' => 'CondoController@create'
        ]);
        Route::post('/lagre', [
            'as' => 'c-store',
            'uses' => 'CondoController@store'
        ]);
        Route::get('/{id}', [
            'as' => 'c-show',
            'uses' => 'CondoController@show'
        ]);
        Route::get('/{id}/endre', [
            'as' => 'c-edit',
            'uses' => 'CondoController@edit'
        ]);
        Route::post('/{id}/oppdater', [
            'as' => 'c-update',
            'uses' => 'CondoController@update'
        ]);
        Route::get('/{id}/slett', [
            'as' => 'c-destroy',
            'uses' => 'CondoController@destroy'
        ]);
    }
);
