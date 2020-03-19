<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'guest'], function () {

    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/install', 'AuthController@install')->name('install');
    Route::get('/auth', 'AuthController@getAuth')->name('get-auth');

});

Route::group(['middleware' => 'spf'], function () {

    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/home', 'HomeController@getHome')->name('home');

});


Route::group(['prefix' => 'webhook'], function () {
    Route::post('/create-product', 'WebhookController@createProduct');
    Route::post('/update-product', 'WebhookController@updateProduct');
    Route::post('/delete-product', 'WebhookController@deleteProduct');
    Route::post('/uninstall-app', 'WebhookController@uninstallApp');

});

Route::get('/debug-sentry', function () {
    throw new Exception('My 1 Sentry error!');
});

//Route::get('/admin', 'AdminController@index')->name('admin');
