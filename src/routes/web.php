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
    /************************\
    --- user ---
    \************************/
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
    // lrave
    Route::get('users/leave/', 'UserController@leave');
    Route::post('users/leave', 'UserController@leaveAction');

    // --- item list
    Route::get('users/item/list', 'UserController@itemList')->name('item_list');
    // --- item group
    Route::get('users/item/group', 'UserController@itemGroup')->name('item_group');

    /************************\
    --- admin ---
    \************************/
    Route::get('admin', 'AdminController@index')->name('admin');

    Route::get('admin/error', 'AdminController@error'); //

    // --- user list
    Route::get('admin/user', 'AdminController@user');
    Route::get('admin/user/sort_id_a', 'SortController@adminUser');
    Route::get('admin/user/sort_id_d', 'SortController@adminUser');
    Route::get('admin/user/sort_name_a', 'SortController@adminUser');
    Route::get('admin/user/sort_name_d', 'SortController@adminUser');

    // show user
    Route::get('admin/user/show', 'AdminController@userShow');
    Route::get('admin/user/group', 'AdminController@userGroup');

    // deleted
    Route::get('admin/user/deleted', 'AdminController@userDeleted')->name('user_deleted');
    Route::get('admin/user/deleted/sort_id_a', 'SortController@adminUserDeleted');
    Route::get('admin/user/deleted/sort_id_d', 'SortController@adminUserDeleted');
    Route::get('admin/user/deleted/sort_name_a', 'SortController@adminUserDeleted');
    Route::get('admin/user/deleted/sort_name_d', 'SortController@adminUserDeleted');

    // restore
    Route::post('admin/user/deleted', 'AdminController@userRestore');

    // 一覧からユーザーを削除 ※テスト用、運用時の使用は検討中
    Route::get('admin/user/delete', 'AdminController@userDel');

    // --- create group
    Route::get('admin/create', 'AdminController@create');
    Route::post('admin/create', 'AdminController@createAdd');

    // --- edit group
    Route::get('admin/list', 'AdminController@list');
    Route::get('admin/list/sort_id_a', 'SortController@adminList');
    Route::get('admin/list/sort_id_d', 'SortController@adminList');
    Route::get('admin/list/sort_name_a', 'SortController@adminList');
    Route::get('admin/list/sort_name_d', 'SortController@adminList');

    // group user
    Route::get('admin/group/user', 'AdminController@groupUser');

    // edit group
    Route::get('admin/edit', 'AdminController@edit');
    Route::post('admin/edit', 'AdminController@groupUpdate');

    // group admin
    Route::get('admin/group_admin', 'AdminController@groupAdmin');
    Route::get('admin/group_admin/sort_id_a', 'SortController@adminGroupAdmin');
    Route::get('admin/group_admin/sort_id_d', 'SortController@adminGroupAdmin');
    Route::get('admin/group_admin/sort_name_a', 'SortController@adminGroupAdmin');
    Route::get('admin/group_admin/sort_name_d', 'SortController@adminGroupAdmin');

    // add group admin
    Route::get('admin/group_admin/add', 'AdminController@addGroupAdmin');
    Route::get('admin/group_admin/add/sort_id_a', 'SortController@adminAddGroupAdmin');
    Route::get('admin/group_admin/add/sort_id_d', 'SortController@adminAddGroupAdmin');
    Route::get('admin/group_admin/add/sort_name_a', 'SortController@adminAddGroupAdmin');
    Route::get('admin/group_admin/add/sort_name_d', 'SortController@adminAddGroupAdmin');
    Route::post('admin/group_admin/add', 'AdminController@addGroupAdminAction');

    // delete group admin
    Route::get('admin/group_admin/delete', 'AdminController@deleteGroupAdmin');
    Route::post('admin/group_admin/delete', 'AdminController@deleteGroupAdminAction');

    // delete groop
    Route::get('admin/delete', 'AdminController@delete');
    Route::get('admin/fort', 'AdminController@fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('admin/delete', 'AdminController@deleteAction');

    // deleted group
    Route::get('admin/group/deleted', 'AdminController@deletedGroup')->name('group_deleted');
    Route::get('admin/group/deleted/sort_id_a', 'SortController@adminGroupDeleted');
    Route::get('admin/group/deleted/sort_id_d', 'SortController@adminGroupDeleted');
    Route::get('admin/group/deleted/sort_name_a', 'SortController@adminGroupDeleted');
    Route::get('admin/group/deleted/sort_name_d', 'SortController@adminGroupDeleted');
    Route::post('admin/group/deleted', 'AdminController@groupRestore');

    // --- group ---
    Route::get('group', 'AdminController@groupIndex')->name('group');
    Route::get('group/sort_id_a', 'SortController@group');
    Route::get('group/sort_id_d', 'SortController@group');
    Route::get('group/sort_name_a', 'SortController@group');
    Route::get('group/sort_name_d', 'SortController@group');

    // group user
    Route::get('group/user', 'AdminController@groupUser');
    Route::get('group/user/sort_id_a', 'SortController@groupUser');
    Route::get('group/user/sort_id_d', 'SortController@groupUser');
    Route::get('group/user/sort_name_a', 'SortController@groupUser');
    Route::get('group/user/sort_name_d', 'SortController@groupUser');
    // add user
    Route::get('group/user/add', 'AdminController@addUser');
    Route::get('group/user/add/sort_id_a', 'SortController@groupUserAdd');
    Route::get('group/user/add/sort_id_d', 'SortController@groupUserAdd');
    Route::get('group/user/add/sort_name_a', 'SortController@groupUserAdd');
    Route::get('group/user/add/sort_name_d', 'SortController@groupUserAdd');
    Route::post('group/user/add', 'AdminController@addAction');
    // 一覧からユーザーを削除 ※テスト用、運用時の使用は検討中
    Route::post('group/user/delete', 'AdminController@groupUserDel');


    /************************\
    --- Items List ---
    \************************/

    // --- Items List ---
    Route::get('trips', 'TripController@index')->name('trips');
    Route::get('trips/sort_type_a', 'SortController@itemIndex');
    Route::get('trips/sort_type_d', 'SortController@itemIndex');
    Route::get('trips/sort_title_a', 'SortController@itemIndex');
    Route::get('trips/sort_title_d', 'SortController@itemIndex');
    Route::get('trips/sort_date_a', 'SortController@itemIndex');
    Route::get('trips/sort_date_d', 'SortController@itemIndex');

    Route::get('trips/status', 'TripController@status');

    Route::get('trips/edit', 'TripController@edit');

    Route::get('trips/delete', 'TripController@delete');


    /************************\
    --- Items List ---
    \************************/
});

/**
 ** done
 **/
Route::post('register_add', 'AssistController@registerAdd');
Route::get('users/done', 'DoneController@usersEdit');
Route::get('users/password/done', 'DoneController@usersPassword');
Route::get('users/delete/done', 'DoneController@usersDelete');
Route::get('users/leave/done', 'DoneController@usersLeave');
Route::get('admin/create/done', 'DoneController@adminCreate');
Route::get('admin/edit/done', 'DoneController@adminEdit');
Route::get('admin/group_admin/done', 'DoneController@adminGroupAdminAdd');
Route::get('admin/delete/done', 'DoneController@adminDelete');
Route::get('admin/group/user/done', 'DoneController@groupAddUser');


// ------------------------------------------------------------+
//      done
// ------------------------------------------------------------+

// ------ 未作成
Route::get('calendar', 'UserController@index')->name('calendar');
