<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $is_admin = Auth::user()->is_admin;

        $user_id = Auth::id();
        $g_u = GroupUser::where('user_id', $user_id)->pluck('group_id');
        $Group = Group::whereIn('id' , $g_u)->get();

        $param = ['items' => $Group];

        // dump($user_id);
        // dump($is_admin);
        // dump($g_u);
        return view('/users.index', $Group);
    }

    public function show(Request $req)
    {
        $a_id = Auth::user()->id;
        $item = User::find($a_id);
        $param = ['item' => $item];
        return view('/users.show', $param);
    }

    public function edit()
    {
        return view('/users.edit');
    }

    public function editCheck(UserRequest $req)
    {
        $param = $req->all();
        unset($param['_token']);
        return view('/users.check', $param);
    }

    public function userUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $a_id = Auth::user()->id;
        $user = User::find($a_id);

        $user->fill($val)->update();

        return redirect('/users/done');
    }


    public function account()
    {
        $a_id = Auth::user()->id;
        $param = ['id' => $a_id];
        return view('/users.account', $param);
    }


    public function password()
    {
        return view('/users.password');
    }

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

    public function delete()
    {
        return view('/users.delete');
    }

    public function fort()
    {
        return view('/users.fort');
    }

    public function deleteAction(UserRequest $req)
    {
        $u_id = $req->user_id;
        $a_id = Auth::user()->id;

        if ($u_id != $a_id) {
            Auth::logout();
            return view('welcome');
        } else {
            User::find($u_id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }

    public function group()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();
        if ($group->isEmpty()) {
            $param = 'none';
        }

        $param = ['items' => $group];
        return view('/users.group', $param);
    }

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

    public function leaveAction(Request $req)
    {
        $u_id = Auth::user()->id;
        $g_id = $req->group_id;

        if ($u_id != $u_id) {
            Auth::logout();
            return view('/users.index');
        } else {
            groupUser::where(['group_id' => $g_id, 'user_id' => $u_id])->delete();
            return redirect('/users/leave/done');
        }
    }

    public function itemList()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();

        $table = DB::table('users as u')
        ->join('trips as t', 'u.id', '=', 't.user_id')
        // ->join('group_user', 'users.id','group_user.user_id')
        // ->join('groups as g', 'gu.group_id','g.id')
        ->where('u.id', $a_id)
        ->groupBy('t.item_type')
        // ->where('trips.user_id',$u_id)
        ->get();

        $param = ['items' => $table];
        dump($table);
        dump($a_id);
        // return view('test');
        return view('/users.item_list', $param);
    }


    public function itemGroup()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();

        $param = ['items' => $group];
        return view('/users.item_group', $param);
    }

    // return view('/test');

}
