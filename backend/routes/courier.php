<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-07-11 02:02:56
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-07-20 00:22:06
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

//courier page
    Route::prefix('courier')->group(function ()
    {
        Route::post('/register', 'API\Courier\AuthController@register');
        Route::post('/login', 'API\Courier\AuthController@login');
         //city
        Route::prefix('city')->group(function ()
        {
            Route::get('allcities', 'API\Courier\CityController@getAllCities'); // all cities for dropdown
        });
            //district
        Route::prefix('district')->group(function ()
        {
            Route::get('citiesalldistricts/{cities}', 'API\Courier\DistrictController@getCitiesDistricts');//cities all districts for dropdown
        });

        Route::middleware(['auth:courier', 'scope:courier'])->group( function ()
        {
            Route::post('/logout', 'API\Courier\AuthController@logout');
             //dashboard
            Route::get('dashboard', 'API\Courier\DashboardController@show');
            Route::get('profile', 'API\Courier\AuthController@getProfile');
            Route::put('profile', 'API\Courier\AuthController@updateProfile');
            Route::get('initialdata', 'API\Courier\DashboardController@initialdata');
            Route::prefix('task')->group(function ()
            {
            //sadece il ilçesindeki gönderi bilgilerini görsün-durumunu değiştirebilsin
            //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
                Route::get('/', 'API\Courier\TaskController@index');
                Route::get('/mytasks', 'API\Courier\TaskController@courierTasks');
                Route::get('{task}', 'API\Courier\TaskController@edit');
            // sadece gönderi durumunu değiştirebilsin
                Route::put('{task}', 'API\Courier\TaskController@update');
                Route::put('{task}/cancel', 'API\Courier\TaskController@cancel');
                Route::put('{task}/approved', 'API\Courier\TaskController@approved');

            });


        });
    });
});
