<?php

/**
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date:   2020-07-11 01:59:29
 * @Last Modified by:   @vedatbozkurt
 * @Last Modified time: 2020-07-15 03:45:38
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
Route::prefix('branch')->group(function ()//branch page
{
    Route::post('/login', 'API\Branch\AuthController@login');

    Route::middleware(['auth:branch', 'scope:branch'])->group( function ()
    {
        Route::post('/logout', 'API\Branch\AuthController@logout');
        Route::get('dashboard', 'API\Branch\DashboardController@show');
        Route::get('profile', 'API\Branch\AuthController@getProfile');
        Route::put('profile', 'API\Branch\AuthController@updateProfile');
        Route::get('initialdata', 'API\Branch\DashboardController@initialdata');

        //courier
        Route::prefix('courier')->group(function ()//branch/courier
        {
            //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
            Route::get('/', 'API\Branch\CourierController@index'); // branch couriers
            Route::post('store', 'API\Branch\CourierController@store');
            //branch courier,branch cities,branch districts
            Route::get('allcouriers', 'API\Branch\CourierController@allCouriers');//for creating task dropworn
            Route::get('{courier}', 'API\Branch\CourierController@edit'); //sadece kendi kuryesini edit
            Route::put('{courier}', 'API\Branch\CourierController@update');//sadece kendi kuryesini update
            Route::delete('{courier}', 'API\Branch\CourierController@destroy');//sadece kendi kuryesini delete
            Route::get('{courier}/tasks', 'API\Branch\CourierController@tasks'); //sadece kendi kuryesinin gönderileri

        });

        Route::prefix('user')->group(function () //branch/user
        {
            Route::get('/', 'API\Branch\UserController@index'); // user
            Route::get('all', 'API\Branch\UserController@all'); // user
            Route::post('store', 'API\Branch\UserController@store');
            Route::get('{user}', 'API\Branch\UserController@edit'); // user
            Route::put('{user}', 'API\Branch\UserController@update');
            Route::delete('{user}', 'API\Branch\UserController@destroy');
            // userın adres defteri //user->addresses
            Route::get('{user}/addresses', 'API\Branch\UserController@addresses');
            Route::get('{user}/alladdresses', 'API\Branch\UserController@allAddresses');
            // userın gönderdikleri // user->tasksender
            Route::get('{user}/sendertasks', 'API\Branch\UserController@sendertasks');
            // userın aldıkları // user->taskreceiver
            Route::get('{user}/receivertasks', 'API\Branch\UserController@receivertasks');
        });

        Route::prefix('task')->group(function () //branch/task
        {
            //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
            Route::get('/', 'API\Branch\TaskController@index');
            Route::post('store', 'API\Branch\TaskController@store');
            // task->courier,sender,receiver,senderaddress(city,district),receiveraddress(city,district)
            Route::get('{task}', 'API\Branch\TaskController@edit');
            Route::put('{task}', 'API\Branch\TaskController@update');
            Route::delete('{task}', 'API\Branch\TaskController@destroy');
        });

        Route::prefix('address')->group(function ()//branch/address
        {
         //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
         Route::get('/', 'API\Branch\AddressController@index');
         Route::post('store', 'API\Branch\AddressController@store');
         Route::get('{address}', 'API\Branch\AddressController@edit');
         Route::put('{address}', 'API\Branch\AddressController@update');
         Route::delete('{address}', 'API\Branch\AddressController@destroy');
     });
         //city
        Route::prefix('city')->group(function ()
        {
            Route::get('allcities', 'API\Branch\CityController@getAllCities'); // all cities for dropdown
            Route::get('cities', 'API\Branch\CityController@getCities'); // all cities for pagination
            Route::get('{city}', 'API\Branch\CityController@edit');
             Route::get('{city}/couriers', 'API\Admin\CityController@couriers'); //city->couriers
            Route::get('{city}/users', 'API\Admin\CityController@users');// city->users
            Route::get('{city}/tasks', 'API\Admin\CityController@tasks');// city->tasks
        });
            //district
        Route::prefix('district')->group(function ()
        {
                Route::get('/', 'API\Branch\DistrictController@index'); //for pagination
               Route::get('citiesalldistricts/{cities}', 'API\Branch\DistrictController@getCitiesDistricts');//cities all districts for dropdown
               Route::get('cityalldistricts/{city}', 'API\Branch\DistrictController@getCityDistricts');//city all districts for dropdown
               Route::get('{district}', 'API\Branch\DistrictController@edit');
            Route::get('{district}/couriers', 'API\Branch\DistrictController@couriers'); //district->couriers
            Route::get('{district}/users', 'API\Branch\DistrictController@users');// district->users
            Route::get('{district}/tasks', 'API\Branch\DistrictController@tasks');// district->tasks

        });
    });
});
});
