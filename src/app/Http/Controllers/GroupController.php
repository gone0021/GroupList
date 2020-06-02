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

    public function createAdd(GroupRequest $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $groups = new Group;
        $groups->fill($val)->save();

        return redirect('/admin/create/done');
    }

    public function list(Request $req)
    {
        $p_num = 7;
        $sort = $req->sort;

        if ($sort == 'id_de') {
            $group = Group::orderBy('id', 'desc')->paginate($p_num);
        } else if ($sort == 'name_de') {
            $group = Group::orderBy('group_name', 'desc')->paginate($p_num);
        } else {
            $group = Group::paginate($p_num);
        }

        if($group->isEmpty())  {
            $group;
        }

        $param = [
            'items' => $group,
            'sort' => $sort,
        ];
        dump($param);

        return view('/admin/list', $param);
    }

    public function edit(Request $req)
    {
        $g_id = $req->group_id;
        $val = Group::find($g_id);

        $param = [
            'id' => $g_id,
            'group_name' => $val->group_name,
            'group_type' => $val->group_type,
        ];

        dump($param);
        return view('/admin.edit', $param);
    }


    public function groupUpdate(GroupRequest $req)
    {
        $g_id = $req->id;
        $val = $req->all();
        unset($val['_token']);

        $group = Group::find($g_id);
        $group->fill($val)->update();

        dump($val);
        return view('/test');

        return redirect('/admin/edit/done');
    }


    // group
    public function groupIndex()
    {

        return view('/admin/group.index');
    }

    public function show(Request $req)
    {
        $a_id = Auth::user()->id;
        $item = User::find($a_id);
        $param = ['item' => $item];
        return view('/users.show', $param);
    }


    // ------ sample ------

    public function account()
    {
        $a_id = Auth::user()->id;
        $param = ['id' => $a_id];
        dump($param);
        return view('/users.account', $param);
    }


    public function password()
    {
        return view('/users.password');
    }

    public function passwordUpdate(UsersRequest $req)
    {
        $a_id = Auth::user()->id;
        $users = User::find($a_id);

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
        $a_id = Auth::user()->id;

        User::find($a_id)->delete();
        Auth::logout();
        return redirect('/users_delete_done');
    }
}
