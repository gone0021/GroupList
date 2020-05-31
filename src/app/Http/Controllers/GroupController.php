<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{
    // admin
    public function index()
    {
        return view('/admin.index');
    }

    public function create()
    {
        return view('/admin.create');
    }

    public function insert(GroupRequest $req)
    {
        $val = $req->group_name;

        $groups = new Group;
        $groups->group_name = $val;
        $groups->save();

        return redirect('/admin/create/done');
    }

    public function list()
    {
        return view('/admin/list');
    }


    // group
    public function groupIndex()
    {

        return view('/admin/group.index');
    }

    public function show(Request $req)
    {
        $id = Auth::user()->id;
        $item = User::find($id);
        $param = ['item' => $item];
        return view('/users.show', $param);
    }




    // ------ 登録なし
    // ------ sample ------
    public function editCheck(UsersRequest $req)
    {
        $param = $req->all();
        unset($param['_token']);
        return view('/users.check', $param);
    }

    public function update(Request $req)
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        $val = $req->all();
        unset($val['_token']);

        $users->fill($val)->update();
        return redirect('/users_done');
    }


    public function account()
    {
        $id = Auth::user()->id;
        $param = ['id' => $id];
        dump($param);
        return view('/users.account', $param);
    }


    public function password()
    {
        return view('/users.password');
    }

    public function passwordUpdate(UsersRequest $req)
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        $inp = $req->password;
        $pass = Hash::make($inp);

        $users->password = $pass;
        $users->update();
        return redirect('/users_password_done');
    }


    public function fort()
    {
        return view('/users.fort');
    }

    public function fortCheck()
    {
        return redirect('/users_delete');
    }

    public function delete()
    {
        return view('/users.delete');
    }

    public function deleteAction()
    {
        $id = Auth::user()->id;

        User::find($id)->delete();
        Auth::logout();
        return redirect('/users_delete_done');
    }
}
