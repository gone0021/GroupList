<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\GroupUse;

class UserController extends Controller
{
    public function index()
    {
        return view('/users.index');
    }

    public function show(Request $req)
    {
        $a_id = Auth::user()->id;
        $item = User::find($a_id);
        $param = ['item' => $item];

        // dump($item);
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

    public function fort()
    {
        return view('/users.fort');
    }

    public function delete()
    {
        return view('/users.delete');
    }

    public function deleteAction(UserRequest $req)
    {
        $u_id = $req->user_id;
        $a_id = Auth::user()->id;

        // idはint、post値はstringのため==で比較
        if ($u_id != $a_id) {
            Auth::logout();
            return view('welcome');
        } else {
            // User::find($u_id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }

    public function group()
    {
        $a_id = Auth::user()->id;
        $group = User::find($a_id)->group()->get();
        if($group->isEmpty())  {
            $param = 'none';
        }

        $param = ['items' => $group];
        dump($param);


        return view('/users.group', $param);
    }

    public function leave(Request $req)
    {
        // group_idをget
        $g_id = $req->group_id;

        $val = Group::find($g_id);
        $param = [
            'id' => $val->id,
            "group_name" => $val->group_name,
        ];

        dump($param);
        return view('/users.leave', $param);
    }

    public function leaveAction(Request $req)
    {
        $a_id = Auth::user()->id;
        $g_id = $req->group_id;
        // postされる値は文字列のためintへ
        $u_id = (int)$req->user_id;

        if ($a_id !== $u_id) {
            Auth::logout();
            return view('/users.index');
        } else {
            groupUser::where([ 'group_id' => $g_id, 'user_id' => $u_id ])->delete();
            return redirect('/users/leave/done');
        }
    }

    // return view('/test');

}
