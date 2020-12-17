<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
GET         /photos                 index   photos.index
GET         /photos/create          create  photos.create
POST        /photos                 store   photos.store
GET         /photos/{photo}         show    photos.show
GET         /photos/{photo}/edit    edit    photos.edit
PUT/PATCH   /photos/{photo}         update  photos.update
DELETE      /photos/{photo}         destroy photos.destroy

GET         /photos/{photo}/comments        index   photos.comments.index
GET         /photos/{photo}/comments/create create  photos.comments.create
POST        /photos/{photo}/comments        store   photos.comments.store
GET         /comments/{comment}             show    comments.show
GET         /comments/{comment}/edit        edit    comments.edit
PUT/PATCH   /comments/{comment}             update  comments.update
DELETE      /comments/{comment}             destroy comments.destroy
*/
Route::prefix('v1')->group(function () {
    //http://127.0.0.1:8000/api/v1/admin/
    Route::prefix('admin')->group(function () {
        Route::post('/register', 'API\Admin\AuthController@register');
        Route::post('/login', 'API\Admin\AuthController@login');

        // Route::middleware('auth:admin')->group( function () {
            //profile
        Route::get('getprofile', 'API\Admin\AuthController@getProfile');
        Route::put('updateprofile', 'API\Admin\AuthController@updateProfile');
        //branch
        Route::prefix('branch')->group(function () {
            Route::get('/', 'Api\Admin\BranchController@index');
            Route::post('store', 'Api\Admin\BranchController@store');
            Route::put('{branch}', 'Api\Admin\BranchController@update');
            Route::delete('{branch}', 'Api\Admin\BranchController@destroy');
            Route::post('{branch}/restore', 'Api\Admin\BranchController@restore');
            Route::get('{branch}/citycouriers', 'Api\Admin\BranchController@citycouriers');
            Route::get('{branch}/districtcouriers', 'Api\Admin\BranchController@districtcouriers');
        });

            //courier
        Route::get('courier', 'Api\Admin\CourierController@index');
        Route::post('courier/store', 'Api\Admin\CourierController@store');
        Route::put('courier/{courier}', 'Api\Admin\CourierController@update');
        Route::delete('courier/{courier}', 'Api\Admin\CourierController@destroy');
        Route::post('courier/{courier}/restore', 'Api\Admin\CourierController@restore');
             //user(customer)
        Route::get('user', 'Api\Admin\UserController@index');
        Route::post('user/store', 'Api\Admin\UserController@store');
        Route::put('user/{user}', 'Api\Admin\UserController@update');
        Route::delete('user/{user}', 'Api\Admin\UserController@destroy');
        Route::post('user/{user}/restore', 'Api\Admin\UserController@restore');
            //task
        Route::get('task', 'Api\Admin\TaskController@index');
        Route::post('task/store', 'Api\Admin\TaskController@store');
        Route::put('task/{task}', 'Api\Admin\TaskController@update');
        Route::delete('task/{task}', 'Api\Admin\TaskController@destroy');
        Route::post('task/{task}/restore', 'Api\Admin\TaskController@restore');
            //address
        Route::get('address', 'Api\Admin\AddressController@index');
        Route::post('address/store', 'Api\Admin\AddressController@store');
        Route::put('address/{address}', 'Api\Admin\AddressController@update');
        Route::delete('address/{address}', 'Api\Admin\AddressController@destroy');

             //city
        Route::prefix('city')->group(function () {
            Route::get('/', 'Api\Admin\CityController@index');
            Route::post('city/store', 'Api\Admin\CityController@store');
            Route::put('city/{city}', 'Api\Admin\CityController@update');
            Route::delete('city/{city}', 'Api\Admin\CityController@destroy');
            Route::get('{city}/districts', 'Api\Admin\CityController@districts'); //city districts
            Route::get('{city}/couriers', 'Api\Admin\CityController@couriers'); //city couriers
            Route::get('{city}/branches', 'Api\Admin\CityController@branches'); //city branches
            // Route::get('{city}/addresses', 'Api\Admin\CityController@addresses');// city addresses
            Route::get('{city}/users', 'Api\Admin\CityController@users');// city users
            Route::get('{city}/tasks', 'Api\Admin\CityController@tasks');// city tasks
        });

             //district
        Route::prefix('district')->group(function () {
            Route::get('/', 'Api\Admin\DistrictController@index');
            Route::post('store', 'Api\Admin\DistrictController@store');
            Route::put('{district}', 'Api\Admin\DistrictController@update');
            Route::delete('{district}', 'Api\Admin\DistrictController@destroy');
            Route::get('{district}/couriers', 'Api\Admin\DistrictController@couriers'); //district couriers
            Route::get('{district}/branches', 'Api\Admin\DistrictController@branches'); //district branches
            Route::get('{district}/users', 'Api\Admin\DistrictController@users');// district users
            Route::get('{district}/tasks', 'Api\Admin\DistrictController@tasks');// district tasks
        });
            //dashboard
        Route::get('user/{id}', 'API\Admin\DashboardController@show');
        // });
    });

});
