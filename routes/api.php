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
//        Route::post('/login', 'API\Development\FakeAuthenticateController@login')->name('dev.login');
    });
});

Route::group(['prefix' => 'client'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'API\Client\AuthenticateController@login');
//        Route::post('register', 'API\Client\AuthenticateController@register'); // Development
    });

    Route::group(['middleware' => 'auth.api'], function() {
        Route::group(['prefix' => 'auth'], function(){
            Route::post('logout', 'API\Client\AuthenticateController@logout');
        });

        // Enroll user
        Route::post('enroll/user', 'API\Client\AuthenticateController@enrollUser');

        // Users
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', 'API\Client\UserController@index')->name('users.get');
            //...
        });

        // Organization
        Route::group(['prefix' => 'organization'], function(){
            Route::get('/statistical', 'API\Client\OrganizationController@statistical')->name('organization.statistical');
            Route::get('/', 'API\Client\OrganizationController@index')->name('organization.list');
            Route::patch('/', 'API\Client\OrganizationController@update')->name('organization.update');
            Route::get('/users', 'API\Client\OrganizationController@users')->name('organization.users.list');
            Route::post('/update-user', 'API\Client\OrganizationController@updateUser')->name('organization.users.update');
            Route::get('/setting', 'API\Client\OrganizationController@getSetting')->name('organization.setting.get');
            Route::post('/setting', 'API\Client\OrganizationController@changeSetting')->name('organization.setting.update');

        });

        // Major
        Route::group(['prefix' => 'majors'], function(){
            Route::get('/', 'API\Client\MajorController@index')->name('major.list');
            Route::post('/', 'API\Client\MajorController@create')->name('major.create');
            Route::post('/assign', 'API\Client\MajorController@assignSubject')->name('major.assign');
            Route::patch('/', 'API\Client\MajorController@update')->name('major.update');
            Route::delete('/', 'API\Client\MajorController@delete')->name('major.delete');
        });

        // Subject
        Route::group(['prefix' => 'subjects'], function (){
            Route::get('/', 'API\Client\SubjectController@index')->name('subject.list');
            Route::post('/', 'API\Client\SubjectController@create')->name('subject.create.single');
//            Route::post('/multiple', 'API\Client\SubjectController@createMultipleSubject')->name('subject.create.multiple');
            Route::patch('/', 'API\Client\SubjectController@update')->name('subject.update');
            Route::delete('/', 'API\Client\SubjectController@delete')->name('subject.delete');
        });

        // ClassRoom
        Route::group(['prefix' => 'classrooms'], function(){
            Route::get('/', 'API\Client\ClassRoomController@showListClassRoom')->name('classroom.list');
            Route::post('/', 'API\Client\ClassRoomController@create')->name('classroom.create');
            Route::patch('/', 'API\Client\ClassRoomController@update')->name('classroom.update');
            Route::delete('/', 'API\Client\ClassRoomController@delete')->name('classroom.delete');
            //...
        });

        // Transcript
        Route::group(['prefix' => 'transcripts'], function(){
            Route::get('/get-all', 'API\Client\TranscriptController@index')->name('transcript.list');
            Route::get('/get-by-student-code', 'API\Client\TranscriptController@getByStudentCode')->name('transcript.get-by-student-code');
            Route::get('/get-by-trxid', 'API\Client\TranscriptController@getByTrxId')->name('transcript.get-by-trxid');
            Route::post('/history', 'API\Client\TranscriptController@history')->name('transcript.history');
            Route::post('/submit', 'API\Client\TranscriptController@submit')->name('transcript.submit');
            Route::post('/submit-raw', 'API\Client\TranscriptController@submitRaw')->name('transcript.submit.raw');
            Route::patch('/update', 'API\Client\TranscriptController@update')->name('transcript.update');
//            Route::delete('/', 'API\Client\TranscriptController@delete')->name('transcript.delete');
        });

        // In Queue Transcript
        Route::group(['prefix' => 'queue-transcripts'], function(){
            Route::get('/', 'API\Client\InQueueTranscriptController@index')->name('queue.transcript.list');
            Route::post('/approve', 'API\Client\InQueueTranscriptController@approve')->name('queue.transcript.approve');
            //...
        });

        // Roles
        Route::group(['prefix' => 'roles'], function(){
            Route::get('/', 'API\Client\RoleController@index')->name('role.list');
            Route::post('/', 'API\Client\RoleController@create')->name('role.create');
            Route::post('/sync', 'API\Client\RoleController@updatePermissionForRole')->name('role.sync.specific');
            Route::post('/sync-all-permissions', 'API\Client\RoleController@syncAllPermissionForRole')->name('role.sync.all');
            Route::patch('/', 'API\Client\RoleController@update')->name('role.update.role');
            Route::delete('/', 'API\Client\RoleController@delete')->name('role.delete');
        });

        // Permissions
        Route::group(['prefix' => 'permissions'], function(){
            Route::get('/', 'API\Client\PermissionController@index')->name('permission.list');
        });

        // Integrated API
        Route::group(['prefix' => 'integrated'], function(){
            //...
        });

    });
});

