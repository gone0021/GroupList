<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// ------

// auth
Route::post('register_check', 'AssistController@registerCheck');
Route::post('register_add', 'AssistController@registerAdd');
Route::get('register_done', 'DoneController@register');

Route::post('password_check', 'AssistController@passwordCheck');

Route::middleware('auth')->group(function () {
    // user
    Route::get('users', 'UserController@index')->name('users'); //

    Route::get('users/show', 'UserController@show');

    Route::get('users/edit', 'UserController@edit'); //
    Route::post('users/edit', 'UserController@editCheck');
    Route::post('users/update', 'UserController@userUpdate');

    Route::get('users/account', 'UserController@account'); //

    Route::get('users/password', 'UserController@password'); //
    Route::post('users/password', 'UserController@passwordUpdate');

    Route::get('users/delete', 'UserController@delete'); //
    Route::get('users/fort', 'UserController@fort'); //
    Route::post('users/delete', 'UserController@deleteAction');

    Route::get('users/group', 'UserController@group');

    Route::get('users/leave/', 'UserController@leave');
    Route::post('users/leave', 'UserController@leaveAction');

    // admin
    Route::get('admin', 'GroupController@index')->name('admin'); //
    Route::get('admin/create', 'GroupController@create');
    Route::post('admin/create', 'GroupController@createAdd');

    Route::get('admin/list', 'GroupController@list');
    Route::get('admin/edit', 'GroupController@edit');
    Route::post('admin/edit', 'GroupController@groupUpdate');

    // admin group


    // ------ 作成中

    Route::get('group', 'GroupController@groupIndex')->name('group');
});

// ----- done
Route::get('users/done', 'DoneController@usersEdit');
Route::get('users/password/done', 'DoneController@usersPassword');
Route::get('users/delete/done', 'DoneController@usersDelete');
Route::get('users/leave/done', 'DoneController@usersLeave');
Route::get('admin/create/done', 'DoneController@adminCreate');
Route::get('admin/edit/done', 'DoneController@adminEdit');



// ------ 作るか悩み中
Route::get('admin/fort', 'UserController@fort'); //
Route::post('admin/ort', 'UserController@fortCheck');


// ------ 未作成
Route::get('group_list', 'GroupController@new');

Route::get('mygroup', 'UserController@index')->name('groups');
Route::get('calendar', 'UserController@index')->name('calendar');
Route::get('items', 'UserController@index')->name('items');
