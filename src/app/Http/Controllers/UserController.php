<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('/users.index');
    }

    public function show(Request $req)
    {
        $id = Auth::user()->id;
        $item = User::find($id);
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

        $id = Auth::user()->id;
        $user = User::find($id);

        $user->fill($val)->update();

        return redirect('/users/done');
    }


    public function account()
    {
        $id = Auth::user()->id;
        $param = ['id' => $id];
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

        $id = Auth::user()->id;
        $user = User::find($id);

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
        $inp = $req->id;
        $id = Auth::user()->id;

        // idはint、post値はstringのため==で比較
        if ($inp != $id) {
            Auth::logout();
            return view('welcome');
        } else {
            User::find($id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }


    public function group()
    {
        $id = Auth::user()->id;
        $group = User::find($id)->group()->get();
        if($group->isEmpty())  {
            $param = 'none';
        }

        $param = ['items' => $group];
        dump($param);


        return view('/users.group', $param);
    }

    public function leave(Request $req)
    {
        $id = $req->input('id');

        $group = New Group;
        $val = $group->find($id);
        $param = [
            'id' => $val->id,
            "group_name" => $val->group_name,
        ];

        dump($param);
        return view('/users.leave', $param);
    }

    public function leaveAction(Request $req)
    {
        $inp = $req->id;
        $id = Auth::user()->id;

        $group = User::find($id)->group();


        // idはint、post値は文字列のため==で比較
        if ($inp != $id) {
            Auth::logout();
            return view('welcome');
        } else {
            User::find($id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }
    // dump($param);

}
