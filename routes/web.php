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
        Artisan::call('sameie:update');
        return redirect('/')->with('status', 'DB has been reset.');
    });
    Route::get('/test', function () {
        App::abort(404);
    });
}
/*
| END DEBUG ONLY
*/

Route::get('locale/{locale}', ['as' => 'locale', 'uses' => 'HomeController@locale']);

Route::get('logginn', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logginn', 'Auth\LoginController@login');
Route::post('loggut', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('registrer', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrer', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('passord/tilbakestill', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('passord/epost', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('passord/tilbakestill/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('passord/tilbakestill', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verify Routes...
Route::get('epost/sendigjen', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('epost/verifiser', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('epost/verifiser/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('/', 'HomeController@index')->name('dashboard')->middleware('verified');

//Route::resource('c', 'CondoController');

Route::resource('s', 'SubscribeController')->middleware('auth');
Route::resource('pm', 'PaymentMethodController')->middleware('auth');

Route::group(
    [
        'prefix' => 'c',
        'middleware' => 'auth'
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
