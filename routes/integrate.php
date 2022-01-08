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


Route::group(['middleware' => 'api.integration'], function () {

    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'API\Integrate\AuthenticateController@login');
    });

    // Enroll user
    Route::post('enroll/user', 'API\Integrate\AuthenticateController@enrollUser');

    // Organization
    Route::group(['prefix' => 'organization'], function () {
        Route::get('/', 'API\Integrate\OrganizationController@index')->name('organization.list');
        Route::patch('/', 'API\Integrate\OrganizationController@update')->name('organization.update');
        Route::get('/users', 'API\Integrate\OrganizationController@users')->name('organization.users');
        Route::get('/setting', 'API\Integrate\OrganizationController@getSetting')->name('organization.setting.get');
        Route::post('/setting', 'API\Integrate\OrganizationController@changeSetting')->name('organization.setting.update');

    });

    // Major
    Route::group(['prefix' => 'majors'], function () {
        Route::get('/', 'API\Integrate\MajorController@index')->name('major.list');
        Route::post('/', 'API\Integrate\MajorController@create')->name('major.create');
        Route::post('/assign', 'API\Integrate\MajorController@assignSubject')->name('major.assign');
        Route::patch('/', 'API\Integrate\MajorController@update')->name('major.update');
        Route::delete('/', 'API\Integrate\MajorController@delete')->name('major.delete');
    });

    // Subject
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/', 'API\Integrate\SubjectController@index')->name('subject.list');
        Route::post('/', 'API\Integrate\SubjectController@create')->name('subject.create.single');
//            Route::post('/multiple', 'API\Integrate\SubjectController@createMultipleSubject')->name('subject.create.multiple');
        Route::patch('/', 'API\Integrate\SubjectController@update')->name('subject.update');
        Route::delete('/', 'API\Integrate\SubjectController@delete')->name('subject.delete');
    });

    // ClassRoom
    Route::group(['prefix' => 'classrooms'], function () {
        Route::get('/', 'API\Integrate\ClassRoomController@showListClassRoom')->name('classroom.list');
        Route::post('/', 'API\Integrate\ClassRoomController@create')->name('classroom.create');
        Route::patch('/', 'API\Integrate\ClassRoomController@update')->name('classroom.update');
        Route::delete('/', 'API\Integrate\ClassRoomController@delete')->name('classroom.delete');
        //...
    });

    // Transcript
    Route::group(['prefix' => 'transcripts'], function () {
        Route::get('/get-all', 'API\Integrate\TranscriptController@index')->name('transcript.list');
        Route::get('/get-by-student-code', 'API\Integrate\TranscriptController@getByStudentCode')->name('transcript.get-by-student-code');
        Route::get('/get-by-trxid', 'API\Integrate\TranscriptController@getByTrxId')->name('transcript.get-by-trxid');
        Route::post('/history', 'API\Integrate\TranscriptController@history')->name('transcript.history');
        Route::post('/submit', 'API\Integrate\TranscriptController@submit')->name('transcript.submit');
        Route::post('/submit-raw', 'API\Integrate\TranscriptController@submitRaw')->name('transcript.submit.raw');
        Route::patch('/update', 'API\Integrate\TranscriptController@update')->name('transcript.update');
//            Route::delete('/', 'API\Integrate\TranscriptController@index')->name('transcript.delete');
    });

    // In Queue Transcript
    Route::group(['prefix' => 'queue-transcripts'], function () {
        Route::get('/', 'API\Integrate\InQueueTranscriptController@iInQueueTranscriptControllerndex')->name('queue.transcript.list');
        Route::post('/approve', 'API\Integrate\@approve')->name('queue.transcript.approve');
        //...
    });

    // Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'API\Integrate\RoleController@index')->name('role.list');
        Route::post('/', 'API\Integrate\RoleController@create')->name('role.create');
        Route::post('/sync', 'API\Integrate\RoleController@updatePermissionForRole')->name('role.sync.specific');
        Route::post('/sync-all-permissions', 'API\Integrate\RoleController@syncAllPermissionForRole')->name('role.sync.all');
        Route::patch('/', 'API\Integrate\RoleController@update')->name('role.update.role');
        Route::delete('/', 'API\Integrate\RoleController@delete')->name('role.delete');
    });

    // Permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'API\Integrate\PermissionController@index')->name('permission.list');
    });

});

