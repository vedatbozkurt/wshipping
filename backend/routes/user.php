<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-07-11 02:03:01
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-07-11 02:04:00
 */

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
Route::prefix('v1')->group(function ()
{

Route::prefix('user')->group(function () //customer page
{
    Route::post('/register', 'API\User\AuthController@register');
    Route::post('/login', 'API\User\AuthController@login');
    Route::middleware(['auth:user', 'scope:user'])->group( function ()
    {
        //dashboard
        Route::get('/', 'API\User\DashboardController@show');
        Route::get('profile', 'API\User\AuthController@getProfile');
        Route::put('profile', 'API\User\AuthController@updateProfile');
        Route::prefix('address')->group(function ()
        {
            Route::get('/', 'API\User\AddressController@index');
            Route::post('store', 'API\User\AddressController@store'); //user id post et
            Route::get('{address}', 'API\User\AddressController@edit');
            Route::put('{address}', 'API\User\AddressController@update');
            Route::delete('{address}', 'API\User\AddressController@destroy');
        });

        Route::prefix('task')->group(function ()
        {
            Route::get('/', 'API\User\TaskController@index'); //all
            Route::get('sendertasks', 'API\User\TaskController@sendertasks'); //gönderdikleri
            Route::get('receivertasks', 'API\User\TaskController@receivertasks'); //aldıkları
            Route::post('store', 'API\User\TaskController@store'); //user id post et
            Route::get('{task}', 'API\User\TaskController@edit');
            Route::put('{task}', 'API\User\TaskController@update');
            // Route::delete('{task}', 'API\User\TaskController@destroy');
        });
    });
});
});
