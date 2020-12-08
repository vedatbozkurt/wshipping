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

        Route::middleware('auth:admin')->group( function () {
            //profile
            Route::get('getprofile', 'API\Admin\AuthController@getProfile');
            Route::put('updateprofile', 'API\Admin\AuthController@updateProfile');
            //branch
            Route::get('branch', 'Api\Admin\BranchController@index');
            Route::post('branch/store', 'Api\Admin\BranchController@store');
            Route::put('branch/{branch}', 'Api\Admin\BranchController@update');
            Route::delete('branch/{branch}', 'Api\Admin\BranchController@destroy');
            Route::post('branch/{branch}/restore', 'Api\Admin\BranchController@restore');

            //dashboard
            Route::get('user/{id}', 'API\Admin\DashboardController@show');
        });
    });

});
