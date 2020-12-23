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
        Route::post('/register', 'API\Admin\AuthController@register');
        Route::post('/login', 'API\Admin\AuthController@login');

        Route::middleware(['auth:admin', 'scope:admin'])->group( function () {
        //profile
            Route::get('profile', 'API\Admin\AuthController@getProfile');
            Route::put('profile', 'API\Admin\AuthController@updateProfile');
        //branch
            Route::prefix('branch')->group(function ()
            {
            Route::get('/', 'Api\Admin\BranchController@index'); // branch
            Route::post('store', 'Api\Admin\BranchController@store');
            Route::get('{branch}', 'Api\Admin\BranchController@edit');//branch,districts,cities
            Route::put('{branch}', 'Api\Admin\BranchController@update');
            Route::delete('{branch}', 'Api\Admin\BranchController@destroy');
            Route::post('{branch}/restore', 'Api\Admin\BranchController@restore');
            //şubenin il ve ilçelerinin tümünün kuryeleri yani şubenin tüm kuryeleri
            Route::get('{branch}/couriers', 'Api\Admin\BranchController@couriers');//sadece courier bilgisi göster yeterli
            //şubenin illerinin kuryeleri //branch->city->couriers
            Route::get('{branch}/citycouriers', 'Api\Admin\BranchController@citycouriers');
            //şubenin ilçelerinin kuryeleri //branch->district->couriers
            Route::get('{branch}/districtcouriers', 'Api\Admin\BranchController@districtcouriers');
            //şubenin il ve ilçelerinin tümünün müşterileri yani şubenin tüm müşterileri
            Route::get('{branch}/users', 'Api\Admin\BranchController@users');//sadece müşteri bilgisi göster yeterli
            //şubenin illerinin müşterileri //branch->city->users
            Route::get('{branch}/cityusers', 'Api\Admin\BranchController@cityusers');
            //şubenin ilçelerinin müşterileri //branch->district->users
            Route::get('{branch}/districtusers', 'Api\Admin\BranchController@districtusers');
            //şubenin il ve ilçelerinin tümünün gönderileri yani şubenin tüm gönderileri
            Route::get('{branch}/tasks', 'Api\Admin\BranchController@tasks');//sadece gönderi bilgisi göster yeterli
            //şubenin illerinin gönderileri  //branch->city->tasks
            Route::get('{branch}/citytasks', 'Api\Admin\BranchController@citytasks');
            //şubenin ilçelerinin gönderileri //branch->district->tasks
            Route::get('{branch}/districttasks', 'Api\Admin\BranchController@districttasks');
        });

        //courier
            Route::prefix('courier')->group(function ()
            {
            Route::get('/', 'Api\Admin\CourierController@index'); // courier
            Route::post('store', 'Api\Admin\CourierController@store');
            Route::get('{courier}', 'Api\Admin\CourierController@edit'); //courier,cities,districts
            Route::put('{courier}', 'Api\Admin\CourierController@update');
            Route::delete('{courier}', 'Api\Admin\CourierController@destroy');
            Route::post('{courier}/restore', 'Api\Admin\CourierController@restore');
            //kurye çalıştıgı illerinin şubeleri //courier->city->branches
            Route::get('{courier}/citybranches', 'Api\Admin\CourierController@citybranches');
            //kuryenin çalıştıgı ilçelerin şubeleri //courier->district->branches
            Route::get('{courier}/districtbranches', 'Api\Admin\CourierController@districtbranches');
            Route::get('{courier}/tasks', 'Api\Admin\CourierController@tasks'); //courier->tasks
        });

        //user(customer)
            Route::prefix('user')->group(function ()
            {
            Route::get('/', 'Api\Admin\UserController@index'); // user
            Route::post('store', 'Api\Admin\UserController@store');
            Route::get('{user}', 'Api\Admin\UserController@edit'); // user
            Route::put('{user}', 'Api\Admin\UserController@update');
            Route::delete('{user}', 'Api\Admin\UserController@destroy');
            Route::post('{user}/restore', 'Api\Admin\UserController@restore');
             // userın adres defteri //user->addresses
            Route::get('{user}/addresses', 'Api\Admin\UserController@addresses');
             // userın gönderdikleri // user->tasksender
            Route::get('{user}/sendertasks', 'Api\Admin\UserController@sendertasks');
             // userın aldıkları // user->taskreceiver
            Route::get('{user}/receivertasks', 'Api\Admin\UserController@receivertasks');
        });

        //task
            Route::prefix('task')->group(function ()
            {
            // task->courier,sender,receiver,senderaddress(city,district),receiveraddress(city,district)
                Route::get('/', 'Api\Admin\TaskController@index');
                Route::post('store', 'Api\Admin\TaskController@store');
             // task->courier,sender,receiver,senderaddress(city,district),receiveraddress(city,district)
                Route::get('{task}', 'Api\Admin\TaskController@edit');
                Route::put('{task}', 'Api\Admin\TaskController@update');
                Route::delete('{task}', 'Api\Admin\TaskController@destroy');
                Route::post('{task}/restore', 'Api\Admin\TaskController@restore');
            });

        //address
            Route::prefix('address')->group(function ()
            {
                Route::get('/', 'Api\Admin\AddressController@index');
                Route::post('store', 'Api\Admin\AddressController@store');
                Route::get('{address}', 'Api\Admin\AddressController@edit');
                Route::put('{address}', 'Api\Admin\AddressController@update');
                Route::delete('{address}', 'Api\Admin\AddressController@destroy');
            });

        //city
            Route::prefix('city')->group(function ()
            {
                Route::get('/', 'Api\Admin\CityController@index');
                Route::post('city/store', 'Api\Admin\CityController@store');
                Route::get('{city}', 'Api\Admin\CityController@edit');
                Route::put('city/{city}', 'Api\Admin\CityController@update');
                Route::delete('city/{city}', 'Api\Admin\CityController@destroy');
            Route::get('{city}/districts', 'Api\Admin\CityController@districts'); //city districts
            Route::get('{city}/couriers', 'Api\Admin\CityController@couriers'); //city->couriers
            Route::get('{city}/branches', 'Api\Admin\CityController@branches'); //city->branches
            // Route::get('{city}/addresses', 'Api\Admin\CityController@addresses');// city addresses
            Route::get('{city}/users', 'Api\Admin\CityController@users');// city->users
            Route::get('{city}/tasks', 'Api\Admin\CityController@tasks');// city->tasks
        });

        //district
            Route::prefix('district')->group(function ()
            {
                Route::get('/', 'Api\Admin\DistrictController@index');
                Route::post('store', 'Api\Admin\DistrictController@store');
                Route::get('{district}', 'Api\Admin\DistrictController@edit');
                Route::put('{district}', 'Api\Admin\DistrictController@update');
                Route::delete('{district}', 'Api\Admin\DistrictController@destroy');
            Route::get('{district}/couriers', 'Api\Admin\DistrictController@couriers'); //district->couriers
            Route::get('{district}/branches', 'Api\Admin\DistrictController@branches'); //district->branches
            Route::get('{district}/users', 'Api\Admin\DistrictController@users');// district->users
            Route::get('{district}/tasks', 'Api\Admin\DistrictController@tasks');// district->tasks
        });
         //dashboard
            Route::get('user/{id}', 'API\Admin\DashboardController@show');
        }); //auth:admin middleware
 }); //admin prefix
    //branch page
Route::prefix('branch')->group(function ()
{
    Route::post('/login', 'API\Branch\AuthController@login');

    Route::middleware(['auth:branch', 'scope:branch'])->group( function ()
    {
        Route::get('profile', 'API\Branch\AuthController@getProfile');
        Route::put('profile', 'API\Branch\AuthController@updateProfile');

        //courier
        Route::prefix('courier')->group(function ()
        {
             //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
            Route::get('/', 'Api\Branch\CourierController@index'); // branch couriers
            Route::get('/citycouriers', 'Api\Branch\CourierController@citycouriers'); // branch city couriers
            Route::get('/districtcouriers', 'Api\Branch\CourierController@districtcouriers'); //branch district couriers
            Route::post('store', 'Api\Branch\CourierController@store');
             //branch courier,branch cities,branch districts
            Route::get('{courier}', 'Api\Branch\CourierController@edit'); //sadece kendi kuryesini edit
            Route::put('{courier}', 'Api\Branch\CourierController@update');//sadece kendi kuryesini update
            Route::delete('{courier}', 'Api\Branch\CourierController@destroy');//sadece kendi kuryesini delete
            Route::get('{courier}/tasks', 'Api\Branch\CourierController@tasks'); //sadece kendi kuryesinin gönderileri
        });

        Route::prefix('user')->group(function ()
        {



        });
        Route::prefix('task')->group(function ()
        {
            //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster


        });
        //address
        Route::prefix('address')->group(function ()
        {
            //store ve edit işlemlerinde sadece şubenin il ve ilçelerini göster
            Route::get('/', 'Api\Admin\AddressController@index');
            Route::post('store', 'Api\Admin\AddressController@store');
            Route::get('{address}', 'Api\Admin\AddressController@edit');
            Route::put('{address}', 'Api\Admin\AddressController@update');
            Route::delete('{address}', 'Api\Admin\AddressController@destroy');
        });

                //dashboard
        Route::get('user/{id}', 'API\Branch\DashboardController@show');
    });
});

    //courier page
Route::prefix('courier')->group(function ()
{
    Route::post('/register', 'API\Courier\AuthController@register');
    Route::post('/login', 'API\Courier\AuthController@login');

    Route::middleware(['auth:courier', 'scope:courier'])->group( function ()
    {
        Route::get('profile', 'API\Courier\AuthController@getProfile');
        Route::put('profile', 'API\Courier\AuthController@updateProfile');

        Route::prefix('task')->group(function ()
        {
            //sadece gönderi bilgilerini görsün-durumunu değiştirebilsin

        });

       //dashboard
        Route::get('user/{id}', 'API\Courier\DashboardController@show');
    });
});
    //customer page
Route::prefix('user')->group(function ()
{
    Route::post('/register', 'API\User\AuthController@register');
    Route::post('/login', 'API\User\AuthController@login');

    Route::middleware(['auth:user', 'scope:user'])->group( function ()
    {
        Route::get('profile', 'API\User\AuthController@getProfile');
        Route::put('profile', 'API\User\AuthController@updateProfile');
            //dashboard
        Route::get('/', 'API\User\DashboardController@show');

        Route::prefix('address')->group(function ()
        {
            Route::get('/', 'Api\User\AddressController@index');
            Route::post('store', 'Api\User\AddressController@store');
            Route::get('{address}', 'Api\User\AddressController@edit');
            Route::put('{address}', 'Api\User\AddressController@update');
            Route::delete('{address}', 'Api\User\AddressController@destroy');
        });

        Route::prefix('task')->group(function ()
        {
                Route::get('sent', 'API\User\TaskController@tasksent'); //kurye, durum vb göster
                Route::get('received', 'API\User\TaskController@taskreceived');
                Route::get('{task}', 'API\User\TaskController@taskedit');
                Route::put('{task}', 'API\User\TaskController@taskupdate');
            });
    });
});
});
