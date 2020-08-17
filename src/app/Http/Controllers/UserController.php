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
use App\helpers;

class UserController extends Controller
{
    /**
     * ユーザーページ
     *
     * @return void
     */
    public function index()
    {
        return view('/users.index');
    }

    /**
     * ユーザー情報の確認
     *
     * @return void
     */
    public function show()
    {
        $item = User::find(Auth::id());
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
     * ユーザー情報の編集：確認画面
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
     * ユーザー情報の編集：実行
     *
     * @return void
     */
    public function userUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $user = User::find(Auth::id());
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
        $param = ['id' =>  Auth::id()];
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
     * パスワードの変更：実行
     *
     * @return void
     */
    public function passwordUpdate(UserRequest $req)
    {
        $pass = Hash::make($req->password);

        $user = User::find(Auth::id());
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
     * ユーザーの削除：実行
     *
     * @return void
     */
    public function deleteAction(UserRequest $req)
    {
        if (!helpers::checkUserId($req->user_id)) {
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
        // 結合によりユーザーidから参加グループを取得
        $group = User::find(Auth::id())->group()->get();

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
        $val = Group::find($req->group_id);
        $param = [
            'id' => $val->id,
            "group_name" => $val->group_name,
        ];
        return view('/users.leave', $param);
    }

    /**
     * グループの脱退：実行
     *
     * @return void
     */
    public function leaveAction(Request $req)
    {
        if (!helpers::checkUserId($req->user_id)) {
            Auth::logout();
            return view('/users.index');
        } else {
            groupUser::where(['group_id' => $req->group_id, 'user_id' =>  Auth::id()])->delete();
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
        // 各アイテムの値を取得
        $dive = DiveLog::where('user_id',  Auth::id())->count();
        $trip = Trip::where('user_id',  Auth::id())->count();
        $plan = Plan::where('user_id',  Auth::id())->count();

        $param = [
            'dive' => $dive,
            'trip' => $trip,
            'plan' => $plan,
        ];
        return view('/users.item_list', $param);
    }

    /**
     * グループごとの投稿
     *
     * @return void
     */
    public function itemGroup()
    {
        $group = User::find( Auth::id())->group()->get();

        $param = ['items' => $group];
        return view('/users.item_group', $param);
    }

    /**
     * 新規投稿
     *
     * @return void
     */
    public function new(Request $req)
    {
        // 1：ダイブログ、2：場所、3：予定
        if ($req->new == 0) {
            return redirect('divelogs/new');
        } else if ($req->new == 1) {
            return redirect('trips/new');
        } else if ($req->new == 2) {
            return redirect('plans/new');
        }
    }
}
