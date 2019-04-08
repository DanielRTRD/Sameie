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
        return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
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
