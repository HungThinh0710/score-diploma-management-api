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

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'API\Admin\AuthenticateController@login')->name('admin.auth.register.dev');;
        Route::post('register', 'API\Admin\AuthenticateController@register')->name('admin.auth.login');;
    });

    Route::group(['middleware' => ['auth.api-admin', 'scope:admin']], function () {
        
        Route::group(['prefix' => 'organizations'], function () {
            Route::get('/', 'API\Admin\OrganizationController@getOrganizations')->name('admin.organizations.list');
            Route::post('/', 'API\Admin\OrganizationController@createOrganization')->name('admin.organizations.create');
            Route::post('/deactivate', 'API\Admin\OrganizationController@deactivateOrganization')->name('admin.organizations.deactivate');
            //...
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'API\Admin\UserController@index')->name('admin.users.list');
            //...
        });
    });

});

