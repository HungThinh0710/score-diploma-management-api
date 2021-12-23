<?php

/*
|--------------------------------------------------------------------------
| API Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'API\Admin\AuthenticateController@login');
        Route::post('register', 'API\Admin\AuthenticateController@register');
    });

    Route::group(['middleware' => ['auth.api-admin', 'scope:admin']], function(){
        Route::get('/test', function (){
           return "passed";
        });
    });

        Route::group(['middleware' => 'auth.api-admin'], function() {

//        Route::group(['prefix' => 'users'], function(){
//            Route::get('/', 'API\Client\UserController@index')->name('users.list');
//            //...
//        });


    });
});

