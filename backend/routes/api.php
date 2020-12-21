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
            //şubenin il ve ilçelerinin tümünün kuryeleri yani şubenin tüm kuryeleri
            Route::get('{branch}/couriers', 'Api\Admin\BranchController@couriers');
            //şubenin illerinin kuryeleri
            Route::get('{branch}/citycouriers', 'Api\Admin\BranchController@citycouriers');
            //şubenin ilçelerinin kuryeleri
            Route::get('{branch}/districtcouriers', 'Api\Admin\BranchController@districtcouriers');
            //şubenin il ve ilçelerinin tümünün müşterileri yani şubenin tüm müşterileri
            Route::get('{branch}/users', 'Api\Admin\BranchController@users');
            //şubenin illerinin müşterileri
            Route::get('{branch}/cityusers', 'Api\Admin\BranchController@cityusers');
            //şubenin ilçelerinin müşterileri
            Route::get('{branch}/districtusers', 'Api\Admin\BranchController@districtusers');
            //şubenin il ve ilçelerinin tümünün gönderileri yani şubenin tüm gönderileri
            Route::get('{branch}/tasks', 'Api\Admin\BranchController@tasks');
            //şubenin illerinin gönderileri
            Route::get('{branch}/citytasks', 'Api\Admin\BranchController@citytasks');
            //şubenin ilçelerinin gönderileri
            Route::get('{branch}/districttasks', 'Api\Admin\BranchController@districttasks');
        });

        //courier
        Route::prefix('courier')->group(function () {
            Route::get('/', 'Api\Admin\CourierController@index');
            Route::post('store', 'Api\Admin\CourierController@store');
            Route::put('{courier}', 'Api\Admin\CourierController@update');
            Route::delete('{courier}', 'Api\Admin\CourierController@destroy');
            Route::post('{courier}/restore', 'Api\Admin\CourierController@restore');
            //kurye illerinin şubeleri
            Route::get('{courier}/citybranches', 'Api\Admin\CourierController@citybranches');
            //kuryenin çalıştıgı ilçelerin şubeleri
            Route::get('{courier}/districtbranches', 'Api\Admin\CourierController@districtbranches');
            Route::get('{courier}/tasks', 'Api\Admin\CourierController@tasks');
        });

        //user(customer)
        Route::prefix('user')->group(function () {
            Route::get('/', 'Api\Admin\UserController@index');
            Route::post('store', 'Api\Admin\UserController@store');
            Route::put('{user}', 'Api\Admin\UserController@update');
            Route::delete('{user}', 'Api\Admin\UserController@destroy');
            Route::post('{user}/restore', 'Api\Admin\UserController@restore');
            Route::get('{user}/addresses', 'Api\Admin\UserController@addresses'); //userın adres defteri
            Route::get('{user}/sendertasks', 'Api\Admin\UserController@sendertasks'); //userın gönderdikleri
            Route::get('{user}/receivertasks', 'Api\Admin\UserController@receivertasks'); //userın aldıkları
        });

        //task
        Route::prefix('task')->group(function () {
            Route::get('/', 'Api\Admin\TaskController@index');
            Route::post('store', 'Api\Admin\TaskController@store');
            Route::put('{task}', 'Api\Admin\TaskController@update');
            Route::delete('{task}', 'Api\Admin\TaskController@destroy');
            Route::post('{task}/restore', 'Api\Admin\TaskController@restore');
            Route::get('{task}', 'Api\Admin\TaskController@index');
        });

        //address
        Route::prefix('address')->group(function () {
            Route::get('/', 'Api\Admin\AddressController@index');
            Route::post('store', 'Api\Admin\AddressController@store');
            Route::put('{address}', 'Api\Admin\AddressController@update');
            Route::delete('{address}', 'Api\Admin\AddressController@destroy');
        });

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
        // }); //auth:admin middleware
    });

});
