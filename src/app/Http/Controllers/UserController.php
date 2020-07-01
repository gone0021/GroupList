<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Trip;
use App\Models\DiveLog;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * ユーザーページ
     *
     * @return void
     */
    public function index()
    {
        $is_admin = Auth::user()->is_admin;

        $user_id = Auth::id();
        $g_u = GroupUser::where('user_id', $user_id)->pluck('group_id');
        $Group = Group::whereIn('id', $g_u)->get();

        $param = ['items' => $Group];

        // dump($user_id);
        // dump($is_admin);
        // dump($g_u);
        return view('/users.index', $Group);
    }

    /**
     * ユーザー情報の確認
     *
     * @return void
     */
    public function show()
    {
        $a_id = Auth::user()->id;
        $item = User::find($a_id);
        $param = ['item' => $item];
        return view('/users.show', $param);
    }

    /**
     * ユーザー情報の編集
     *
     * @return void
     */
    public function edit()
    {
        return view('/users.edit');
    }

    /**
     * ユーザー情報の編集_確認画面
     *
     * @return void
     */
    public function editCheck(UserRequest $req)
    {
        $param = $req->all();
        unset($param['_token']);
        return view('/users.check', $param);
    }

    /**
     * ユーザー情報の編集_実行
     *
     * @return void
     */
    public function userUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $a_id = Auth::user()->id;
        $user = User::find($a_id);

        $user->fill($val)->update();

        return redirect('/users/done');
    }

    /**
     * パスワードの変更・削除
     *
     * @return void
     */
    public function account()
    {
        $a_id = Auth::user()->id;
        $param = ['id' => $a_id];
        return view('/users.account', $param);
    }

    /**
     * パスワードの変更
     *
     * @return void
     */
    public function password()
    {
        return view('/users.password');
    }

    /**
     * パスワードの変更_実行
     *
     * @return void
     */
    public function passwordUpdate(UserRequest $req)
    {
        $inp = $req->password;
        $pass = Hash::make($inp);

        $a_id = Auth::user()->id;
        $user = User::find($a_id);

        $user->password = $pass;
        $user->update();
        return redirect('/users/password/done');
    }

    /**
     * ユーザーの削除
     *
     * @return void
     */
    public function delete()
    {
        return view('/users.delete');
    }

    /**
     * パスワードによる確認
     *
     * @return void
     */
    public function fort()
    {
        return view('/users.fort');
    }

    /**
     * ユーザーの削除_実行
     *
     * @return void
     */
    public function deleteAction(UserRequest $req)
    {
        $a_id = Auth::user()->id;

        if ($req->user_id != $a_id) {
            Auth::logout();
            return view('welcome');
        } else {
            User::find($req->user_id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }

    /**
     * 参加グループ
     *
     * @return void
     */
    public function group()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();

        $param = ['items' => $group];
        return view('/users.group', $param);
    }

    /**
     * グループの脱退
     *
     * @return void
     */
    public function leave(Request $req)
    {
        $g_id = $req->group_id;

        $val = Group::find($g_id);
        $param = [
            'id' => $val->id,
            "group_name" => $val->group_name,
        ];
        return view('/users.leave', $param);
    }

    /**
     * グループの脱退_実行
     *
     * @return void
     */
    public function leaveAction(Request $req)
    {
        $a_id = Auth::user()->id;
        $g_id = $req->group_id;

        if ($req->user_id != $a_id) {
            Auth::logout();
            return view('/users.index');
        } else {
            groupUser::where(['group_id' => $g_id, 'user_id' => $a_id])->delete();
            return redirect('/users/leave/done');
        }
    }

    /**
     * 個人の投稿一覧
     *
     * @return void
     */
    public function itemList()
    {
        $a_id = Auth::id();

        $dive = DiveLog::where('user_id', $a_id)->count();
        $trip = Trip::where('user_id', $a_id)->count();
        $plan = Plan::where('user_id', $a_id)->count();

        $param = [
            'dive' => $dive,
            'trip' => $trip,
            'plan' => $plan,
        ];

        dump($param);
        // return view('test');
        return view('/users.item_list', $param);
    }

    /**
     * グループごとの投稿
     *
     * @return void
     */
    public function itemGroup()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();

        $param = ['items' => $group];
        return view('/users.item_group', $param);
    }

    // return view('/test');

}
