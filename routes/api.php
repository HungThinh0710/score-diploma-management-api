<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'development'], function(){
    Route::group(['prefix' => 'auth'], function() {
        Route::post('/login', 'API\Development\FakeAuthenticateController@login')->name('dev.login');
    });
});

Route::group(['prefix' => 'client'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'API\Client\AuthenticateController@login');
        Route::post('register', 'API\Client\AuthenticateController@register');
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/test', 'API\TestController@test');

        // Organization
        Route::group(['prefix' => 'organization'], function(){
            Route::get('/', 'API\Client\OrganizationController@index')->name('organization.list');
            Route::patch('/', 'API\Client\OrganizationController@update')->name('organization.update');
        });

        // Permission
        Route::group(['prefix' => 'permissions'], function(){
            Route::get('/', 'API\Client\PermissionController@index')->name('permission.list');
        });

        // ClassRoom
        Route::group(['prefix' => 'classrooms'], function(){
            Route::get('/', 'API\Client\ClassRoomController@showListClassRoom')->name('classroom.list');
            Route::post('/', 'API\Client\ClassRoomController@create')->name('classroom.create');
            Route::patch('/', 'API\Client\ClassRoomController@update')->name('classroom.update');
            //...
        });

        // Transcript
        Route::group(['prefix' => 'transcripts'], function(){
            Route::get('/get-all', 'API\Client\TranscriptController@index')->name('transcript.list');
            Route::get('/get-by-student-code', 'API\Client\TranscriptController@getByStudentCode')->name('transcript.get-by-student-code');
            Route::get('/get-by-trxid', 'API\Client\TranscriptController@getByTrxId')->name('transcript.get-by-trxid');
            Route::post('/history', 'API\Client\TranscriptController@history')->name('transcript.history');
            Route::post('/submit', 'API\Client\TranscriptController@submit')->name('transcript.submit');
            Route::patch('/update', 'API\Client\TranscriptController@update')->name('transcript.update');
//            Route::delete('/', 'API\Client\TranscriptController@index')->name('transcript.delete');
        });

        // In Queue Transcript
        Route::group(['prefix' => 'queue-transcripts'], function(){
            Route::get('/', 'API\Client\InQueueTranscriptController@index')->name('queue.transcript.list');
            Route::post('/approve', 'API\Client\InQueueTranscriptController@approve')->name('queue.transcript.approve');
            //...
        });



        // Permissions
        Route::group(['prefix' => 'permissions'], function(){
            Route::get('/', 'API\Client\PermissionController@index')->name('permission.list');
        });

        // Roles
        Route::group(['prefix' => 'roles'], function(){
            Route::get('/', 'API\Client\RoleController@index')->name('role.list');
            Route::post('/', 'API\Client\RoleController@create')->name('role.create');
            Route::patch('/', 'API\Client\RoleController@update')->name('role.update');
            Route::delete('/', 'API\Client\RoleController@delete')->name('role.delete');
        });

        // Integrated API
        Route::group(['prefix' => 'integrated'], function(){
            //...
        });

    });
});

