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

// --- assist
Route::post('register_check', 'AssistController@registerCheck');
Route::get('register_done', 'DoneController@register');

Route::post('password_check', 'AssistController@passwordCheck');

Route::middleware('auth')->group(function () {
    // --- user ---
    Route::get('users', 'UserController@index')->name('users'); //

    // --- show
    Route::get('users/show', 'UserController@show');

    // u edit
    Route::get('users/edit', 'UserController@edit'); //
    Route::post('users/edit', 'UserController@editCheck');
    Route::post('users/update', 'UserController@userUpdate');

    // edit account
    Route::get('users/account', 'UserController@account'); //

    // e password
    Route::get('users/password', 'UserController@password'); //
    Route::post('users/password', 'UserController@passwordUpdate');

    // e delete
    Route::get('users/delete', 'UserController@delete'); //
    Route::get('users/fort', 'UserController@fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('users/delete', 'UserController@deleteAction');

    // --- group list
    Route::get('users/group', 'UserController@group');

    Route::get('users/leave/', 'UserController@leave');
    Route::post('users/leave', 'UserController@leaveAction');

    // --- admin ---
    Route::get('admin', 'AdminController@index')->name('admin'); //

    // --- user list
    Route::get('admin/user', 'AdminController@user');
    Route::get('admin/user/sort_id', 'SortController@adminUser');
    Route::get('admin/user/sort_name', 'SortController@adminUser');

    Route::get('admin/user/show', 'AdminController@userShow');
    Route::get('admin/user/group', 'AdminController@userGroup');

    Route::get('admin/user/deleted', 'AdminController@userDeleted')->name('user_deleted');
    Route::get('admin/user/deleted/sort_id', 'SortController@adminUserDeleted');
    Route::get('admin/user/deleted/sort_name', 'SortController@adminUserDeleted');
    Route::post('admin/user/deleted', 'AdminController@userRestore');

    // テスト用 運用時は使わん
    Route::get('admin/user/delete', 'AdminController@userDel');

    // --- create group
    Route::get('admin/create', 'AdminController@create');
    Route::post('admin/create', 'AdminController@createAdd');

    // --- edit group
    Route::get('admin/list', 'AdminController@list');
    Route::get('admin/list/sort_id', 'SortController@adminList');
    Route::get('admin/list/sort_name', 'SortController@adminList');

    Route::get('admin/group/user', 'AdminController@groupUser');

    Route::get('admin/edit', 'AdminController@edit');
    Route::post('admin/edit', 'AdminController@groupUpdate');

    Route::get('admin/delete', 'AdminController@delete');
    Route::get('admin/fort', 'AdminController@fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('admin/delete', 'AdminController@deleteAction');

    Route::get('admin/group/deleted', 'AdminController@groupDeleted')->name('group_deleted');
    Route::get('admin/group/deleted/sort_id', 'SortController@adminGroupDeleted');
    Route::get('admin/group/deleted/sort_name', 'SortController@adminGroupDeleted');
    Route::post('admin/group/deleted', 'AdminController@groupRestore');

    // --- group
    Route::get('group', 'AdminController@groupIndex')->name('group');
    Route::get('group/sort_id', 'SortController@group');
    Route::get('group/sort_name', 'SortController@group');

    Route::get('group/user', 'AdminController@groupUser');

    Route::get('group/user/add', 'AdminController@addUser');
    Route::get('group/user/add/sort_id', 'SortController@groupUserAdd');
    Route::get('group/user/ad//sort_name', 'SortController@groupUserAdd');


    // --- sort setting ---
    // user
    // Route::get('admin/user/sort_id', 'SortController@adminUser');
    // Route::get('admin/user/sort_name', 'SortController@adminUser');
    // user ---deleted
    // Route::get('admin/user/deleted/sort_id', 'SortController@adminUserDeleted');
    // Route::get('admin/user/deleted/sort_name', 'SortController@adminUserDeleted');
    // admin edit ---list
    // Route::get('admin/list/sort_id', 'SortController@adminList');
    // Route::get('admin/list/sort_name', 'SortController@adminList');
    // group
    // Route::get('group/sort_id', 'SortController@group');
    // Route::get('group/sort_name', 'SortController@group');

    // 作成中
    Route::post('group/user/add', 'AdminController@addAction');

    // ------ 作成中

    Route::get('admin/user/list', 'AdminController@userlist');



});

// ----- done
Route::post('register_add', 'AssistController@registerAdd');
Route::get('users/done', 'DoneController@usersEdit');
Route::get('users/password/done', 'DoneController@usersPassword');
Route::get('users/delete/done', 'DoneController@usersDelete');
Route::get('users/leave/done', 'DoneController@usersLeave');
Route::get('admin/create/done', 'DoneController@adminCreate');
Route::get('admin/edit/done', 'DoneController@adminEdit');
Route::get('admin/delete/done', 'DoneController@adminDelete');
Route::get('admin/group/user/done', 'DoneController@groupAddUser');



// ------ 作るか悩み中


// ------ 未作成
Route::get('group_list', 'AdminController@new');

Route::get('mygroup', 'UserController@index')->name('groups');
Route::get('calendar', 'UserController@index')->name('calendar');
Route::get('items', 'UserController@index')->name('items');
