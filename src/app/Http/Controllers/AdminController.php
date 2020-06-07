<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\GroupUse;

class AdminController extends Controller
{
    public $p_num = 7;
    // --- admin ---
    public function index()
    {
        return view('/admin.index');
    }

    // --- user list ----
    public function user(Request $req)
    {
        $user = User::paginate($this->p_num);

        $param = [
            'items' => $user,
        ];
        dump($param);
        dump(url()->current());

        return view('/admin.user', $param);
    }

    // u show
    public function userShow(Request $req)
    {
        $u_id = $req->user_id;
        $item = User::find($u_id);
        $param = ['item' => $item];

        // dump($item);
        return view('/admin.user_show', $param);
    }

    // u group list
    public function userGroup(Request $req)
    {
        $u_id = $req->user_id;
        $group = User::find($u_id)->group()->get();

        $param = ['items' => $group];
        dump($param);
        return view('/admin.user_group', $param);
    }

    // u delete
    public function userDel(Request $req)
    {
        $u_id = $req->user_id;

        User::find($u_id)->delete();
        return back();
    }

    // --- u deleted
    public function userDeleted(Request $req)
    {
        $user = User::onlyTrashed()->paginate($this->p_num);

        $param = [
            'items' => $user,
        ];

        dump($param);
        return view('/admin.user_deleted', $param);
    }

    // u show soft delete
    public function userRestore(Request $req)
    {
        $u_id = $req->user_id;
        User::onlyTrashed()->where('id', $u_id)->restore();
        return back();
    }

    // --- creat group ---
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

    // --- edit group ---
    public function list(Request $req)
    {
        $group = Group::paginate($this->p_num);

        $param = [
            'items' => $group,
        ];
        dump($param);

        return view('/admin/list', $param);
    }

    // edit
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

    // ---
    public function groupUpdate(GroupRequest $req)
    {
        $g_id = $req->id;
        $val = $req->all();
        unset($val['_token']);

        $group = Group::find($g_id);
        $group->fill($val)->update();

        // dump($val);
        // return view('/test');

        return redirect('/admin/edit/done');
    }

    // delete group
    public function delete(Request $req)
    {
        $g_id = $req->group_id;
        $val = Group::find($g_id);

        $ses = $req->session()->put('group_id', $g_id);
        // $ses = $req->session()->get('group_id');

        $param = [
            'id' => $val->id,
            "group_name" => $val->group_name,
            'ses_id' => $ses,
        ];

        dump($param);
        dump($ses);
        return view('/admin.delete', $param);
    }

    // --- password check
    public function fort(Request $req)
    {
        $ses = $req->session()->get('group_id');
        dump($ses);
        return view('/admin.fort');
    }

    // ---
    public function deleteAction(UserRequest $req)
    {
        $u_id = $req->user_id;
        $a_id = Auth::user()->id;

        $ses = $req->session()->get('group_id');

        // idはint、post値はstringのため==で比較
        if ($u_id != $a_id) {
            Auth::logout();
            $req->session()->pull('group_id');
            return view('welcome');
        } else {
            Group::find($ses)->delete();
            groupUser::where('group_id', $ses)->delete();
            $req->session()->pull('group_id');
            return redirect('/admin/delete/done');
        }
    }

    public function groupDeleted(Request $req)
    {
        $group = Group::onlyTrashed()->paginate($this->p_num);

        $param = [
            'items' => $group,
        ];

        dump($param);
        return view('/admin.group_deleted', $param);
    }

    // u show soft delete
    public function groupRestore(Request $req)
    {
        $g_id = $req->group_id;
        Group::onlyTrashed()->where('id', $g_id)->restore();
        return back();
    }

    // --- group ---
    public function groupIndex(Request $req)
    {
        $group = Group::paginate($this->p_num);

        $param = [
            'items' => $group,
        ];
        dump($param);

        return view('/admin/group.index', $param);
    }

    // user list
    public function groupUser(Request $req)
    {
        $g_id = $req->group_id;

        $user = Group::find($g_id)->user()->get();

        $param = ['items' => $user];
        dump($param);
        return view('/admin/group/user', $param);
    }

    // add user
    public function addUser(Request $req)
    {
        $g_id = $req->group_id;

        $gu = GroupUser::where('group_id', $g_id)->get('user_id');

        $g_items = [
            'g_items' => $gu,
        ];

        // $user_id = array();
        // foreach ($gu->items as $item) {
        //     $user_id = $item->user_id;
        // }


        $user = Group::find($g_id)->user()->get();


        $ses_p = $req->session()->put('group_id', $g_id);
        $ses_g = $req->session()->get('group_id');

        $user = User::paginate($this->p_num);

        // $user = User::whereNotIn('user_id',$gu_id)->paginate($p_num);

        $param = [
            'items' => $user,
            'ses' => $ses_g,
        ];

        dump($param);
        dump($ses_g);
        dump($gu);
        // return view('test');
        return view('/admin/group/add', $param, $g_items);
    }

    // ---
    public function addAction(Request $req)
    {
        $u_id = $req->user_id;
        $ses_g = $req->session()->get('group_id');
        // $ses_p = $req->session()->put('group_id', $ses_g);

        // GroupUser::userId($u_id)->groupId($ses_g)->save();


        $gu = new GroupUser;
        $gu->user_id = $u_id;
        $gu->group_id = $ses_g;
        $gu->update();


        dump($u_id);
        dump($ses_g);
        // return view('test');
        return redirect('/admin/create/done');
    }




    // ------ sample ------
    public function show(Request $req)
    {
        $a_id = Auth::user()->id;
        $item = User::find($a_id);
        $param = ['item' => $item];
        return view('/users.show', $param);
    }

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
}
