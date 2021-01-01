<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::prefix('v1')->group(function ()
{
    //http://127.0.0.1:8000/api/v1/admin/
    //admin page
    Route::prefix('admin')->group(function ()
    {
        // Route::post('/register', 'API\Admin\AuthController@register');
        Route::post('/login', 'API\Admin\AuthController@login');

        Route::middleware(['auth:admin', 'scope:admin'])->group( function () {
            Route::post('/logout', 'API\Admin\AuthController@logout');
            //dashboard
            Route::get('/dashboard', 'API\Admin\DashboardController@show');
            //setting
            Route::get('/setting', 'API\Admin\SettingController@edit');
            Route::put('/setting', 'API\Admin\SettingController@update');
            Route::get('/initialdata', 'API\Admin\SettingController@initialdata');
            //profile
            Route::get('profile', 'API\Admin\AuthController@getProfile');
            Route::put('profile', 'API\Admin\AuthController@updateProfile');
            //branch
            Route::prefix('branch')->group(function ()
            {
                Route::get('/', 'API\Admin\BranchController@index'); // branch
                Route::get('/all', 'API\Admin\BranchController@all'); // user
                Route::post('store', 'API\Admin\BranchController@store');
                Route::get('cities/{branch}', 'API\Admin\BranchController@getBranchCities'); // branch cities
                Route::get('districts/{branch}', 'API\Admin\BranchController@getBranchDistricts'); // Branch Districts
                //şubenin illerinin kuryeleri //branch->city->couriers
                Route::get('citycouriers/{city}', 'API\Admin\BranchController@citycouriers');
                 //şubenin ilçelerinin kuryeleri //branch->district->couriers
                Route::get('districtcouriers/{district}', 'API\Admin\BranchController@districtcouriers');
                //şubenin il ve ilçelerinin tümünün müşterileri yani şubenin tüm müşterileri
                //şubenin illerinin müşterileri //branch->city->users
                Route::get('cityusers/{city}', 'API\Admin\BranchController@cityusers');
                //şubenin ilçelerinin müşterileri //branch->district->users
                Route::get('districtusers/{district}', 'API\Admin\BranchController@districtusers');
                //şubenin il ve ilçelerinin tümünün gönderileri yani şubenin tüm gönderileri
                //şubenin illerinin gönderileri  //branch->city->tasks
                Route::get('citytasks/{city}', 'API\Admin\BranchController@citytasks');
                //şubenin ilçelerinin gönderileri //branch->district->tasks
                Route::get('districttasks/{district}', 'API\Admin\BranchController@districttasks');
                Route::post('{branch}', 'API\Admin\BranchController@search');
                Route::get('{branch}', 'API\Admin\BranchController@edit');
                Route::put('{branch}', 'API\Admin\BranchController@update');
                Route::delete('{branch}', 'API\Admin\BranchController@destroy');
                // Route::post('{branch}/restore', 'API\Admin\BranchController@restore');
                //şubenin il ve ilçelerinin tümünün kuryeleri yani şubenin tüm kuryeleri
                Route::get('{branch}/allcouriers', 'API\Admin\BranchController@allCouriers');//sadece courier bilgisi göster yeterli
                Route::get('{branch}/couriers', 'API\Admin\BranchController@couriers');//sadece courier bilgisi göster yeterli
                Route::get('{branch}/users', 'API\Admin\BranchController@users');//sadece müşteri bilgisi göster yeterli
                Route::get('{branch}/tasks', 'API\Admin\BranchController@tasks');//sadece gönderi bilgisi göster yeterli
            });

            //courier
            Route::prefix('courier')->group(function ()
            {
            Route::get('/', 'API\Admin\CourierController@index'); // courier
            Route::post('store', 'API\Admin\CourierController@store');
            Route::post('{courier}', 'API\Admin\CourierController@search');
            Route::get('{courier}', 'API\Admin\CourierController@edit'); //courier,cities,districts
            Route::put('{courier}', 'API\Admin\CourierController@update');
            Route::delete('{courier}', 'API\Admin\CourierController@destroy');
            Route::post('{courier}/restore', 'API\Admin\CourierController@restore');
            Route::get('cities/{courier}', 'API\Admin\CourierController@getCourierCities'); // courier cities
            Route::get('districts/{courier}', 'API\Admin\CourierController@getCourierDistricts'); // courier Districts
            //kurye çalıştıgı illerinin şubeleri //courier->city->branches
            // Route::get('{courier}/citybranches', 'API\Admin\CourierController@citybranches');
            Route::get('citybranches/{city}', 'API\Admin\CourierController@citybranches');
            //kuryenin çalıştıgı ilçelerin şubeleri //courier->district->branches
            // Route::get('{courier}/districtbranches', 'API\Admin\CourierController@districtbranches');
            Route::get('districtbranches/{district}', 'API\Admin\CourierController@districtbranches');
            Route::get('{courier}/tasks', 'API\Admin\CourierController@tasks'); //courier->tasks
        });

            //user(customer)
            Route::prefix('user')->group(function ()
            {
            Route::get('/', 'API\Admin\UserController@index'); // user
            Route::get('/all', 'API\Admin\UserController@all'); // user
            Route::post('store', 'API\Admin\UserController@store');
            Route::post('{user}', 'API\Admin\UserController@search');
            Route::get('{user}', 'API\Admin\UserController@edit'); // user
            Route::put('{user}', 'API\Admin\UserController@update');
            Route::delete('{user}', 'API\Admin\UserController@destroy');
            Route::post('{user}/restore', 'API\Admin\UserController@restore');
             // userın adres defteri //user->addresses
            Route::get('{user}/addresses', 'API\Admin\UserController@addresses');
            Route::get('{user}/alladdresses', 'API\Admin\UserController@allAddresses');
             // userın gönderdikleri // user->tasksender
            Route::get('{user}/sendertasks', 'API\Admin\UserController@sendertasks');
             // userın aldıkları // user->taskreceiver
            Route::get('{user}/receivertasks', 'API\Admin\UserController@receivertasks');
        });

            //task
            Route::prefix('task')->group(function ()
            {
                // task->courier,sender,receiver,senderaddress(city,district),receiveraddress(city,district)
                Route::get('/', 'API\Admin\TaskController@index');
                Route::post('store', 'API\Admin\TaskController@store');
                Route::post('{task}', 'API\Admin\TaskController@search');
                // task->courier,sender,receiver,senderaddress(city,district),receiveraddress(city,district)
                Route::get('{task}', 'API\Admin\TaskController@edit');
                Route::put('{task}', 'API\Admin\TaskController@update');
                Route::delete('{task}', 'API\Admin\TaskController@destroy');
                Route::post('{task}/restore', 'API\Admin\TaskController@restore');
            });

            //address
            Route::prefix('address')->group(function ()
            {
                Route::get('/', 'API\Admin\AddressController@index');
                Route::post('store', 'API\Admin\AddressController@store');
                Route::get('{address}', 'API\Admin\AddressController@edit');
                Route::put('{address}', 'API\Admin\AddressController@update');
                Route::delete('{address}', 'API\Admin\AddressController@destroy');
            });

            //city
            Route::prefix('city')->group(function ()
            {
            Route::get('/', 'API\Admin\CityController@index'); // all cities for pagination
            Route::get('allcities', 'API\Admin\CityController@getAllCities'); // all cities for dropdown
            Route::post('store', 'API\Admin\CityController@store');
            Route::post('{city}', 'API\Admin\CityController@search');
            Route::get('{city}', 'API\Admin\CityController@edit');
            Route::put('{city}', 'API\Admin\CityController@update');
            Route::delete('{city}', 'API\Admin\CityController@destroy');
            Route::get('{city}/districts', 'API\Admin\CityController@districts'); //city districts
            Route::get('{city}/couriers', 'API\Admin\CityController@couriers'); //city->couriers
            Route::get('{city}/branches', 'API\Admin\CityController@branches'); //city->branches
            // Route::get('{city}/addresses', 'API\Admin\CityController@addresses');// city addresses
            Route::get('{city}/users', 'API\Admin\CityController@users');// city->users
            Route::get('{city}/tasks', 'API\Admin\CityController@tasks');// city->tasks
        });
            //district
            Route::prefix('district')->group(function ()
            {
                Route::get('/', 'API\Admin\DistrictController@index'); //for pagination
               Route::get('citiesalldistricts/{cities}', 'API\Admin\DistrictController@getCitiesDistricts');//cities all districts for dropdown
               Route::get('cityalldistricts/{city}', 'API\Admin\DistrictController@getCityDistricts');//city all districts for dropdown
               Route::post('store', 'API\Admin\DistrictController@store');
               Route::post('{district}', 'API\Admin\DistrictController@search');
               Route::get('{district}', 'API\Admin\DistrictController@edit');
               Route::put('{district}', 'API\Admin\DistrictController@update');
               Route::delete('{district}', 'API\Admin\DistrictController@destroy');
            Route::get('{district}/couriers', 'API\Admin\DistrictController@couriers'); //district->couriers
            Route::get('{district}/branches', 'API\Admin\DistrictController@branches'); //district->branches
            Route::get('{district}/users', 'API\Admin\DistrictController@users');// district->users
            Route::get('{district}/tasks', 'API\Admin\DistrictController@tasks');// district->tasks
        });
        }); //auth:admin middleware
 }); //admin prefix




});
