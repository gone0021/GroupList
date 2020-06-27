<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

class AdminController extends Controller
{
    private $page = 7;

    /**
     * 管理者のチェック
     *
     * @return void
     */
    public function checkAdmin()
    {
        if (Auth::user()->is_admin != 1) {
            // echo 01;
            // return redirect('/admin/error');
            // exit;
            return 0;
        }
    }

    /**
     * 管理者のチェック
     *
     * @return void
     */
    public function checkGroupAdmin()
    {
        if (Auth::user()->is_admin != 1 && Auth::user()->is_admin != 2) {
            return 0;
        }
    }

    /************
    --- user ---
     ************/

    /**
     * エラーページ
     *
     * @return void
     */
    public function error()
    {
        return view('/admin.error');
        exit;
    }

    // --- admin ---
    public function index()
    {
        if ($this->checkGroupAdmin() === 0) {
            return view('/admin.error');
        }

        return view('/admin.index');
    }


    // --- user list ----
    public function user(Request $req)
    {
        // $this->checkAdmin();
        if ($this->checkAdmin() === 0) {
            return view('/admin.error');
        }

        $items = User::paginate($this->page);

        $param = [
            'items' => $items,
        ];
        return view('/admin.user', $param);
    }

    // u show
    public function userShow(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $items = User::find($u_id);

        $param = [
            'items' => $items,
            'title' => __('User Page'),
            'user_name' => $items->user_name,
        ];
        return view('/admin.user_show', $param);
    }

    // u group list
    public function userGroup(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $user = User::find($u_id);
        $group = User::find($u_id)->group()->get();

        $param = [
            'items' => $group,
            'user_name' => $user->user_name,
        ];
        return view('/admin.user_group', $param);
    }

    // u delete
    public function userDel(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        User::find($u_id)->delete();
        return back();
    }

    // --- u deleted
    public function userDeleted(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $user = User::onlyTrashed()->paginate($this->page);

        $param = ['items' => $user];
        return view('/admin.user_deleted', $param);
    }

    // u show soft delete
    public function userRestore(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        User::onlyTrashed()->where('id', $u_id)->restore();
        return back();
    }

    // --- creat group ---
    public function create()
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        return view('/admin.create');
    }

    public function createAdd(GroupRequest $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $val = $req->all();
        unset($val['_token']);

        $groups = new Group;
        $groups->fill($val)->save();

        return redirect('/admin/create/done');
    }

    // --- edit group ---
    public function list(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $req->session()->pull('group_id');
        $group = Group::paginate($this->page);

        $param = ['items' => $group];
        return view('/admin/list', $param);
    }

    // edit
    public function edit(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        $val = Group::find($g_id);

        $param = [
            'id' => $g_id,
            'group_name' => $val->group_name,
            'group_type' => $val->group_type,
        ];
        return view('/admin.edit', $param);
    }

    // ---
    public function groupUpdate(GroupRequest $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->id;
        $val = $req->all();
        unset($val['_token']);

        $group = Group::find($g_id);
        $group->fill($val)->update();

        return redirect('/admin/edit/done');
    }


    // group admin
    public function groupAdmin(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;

        // sessionの保存と取得
        $ses_put = $req->session()->put('group_id', $g_id);
        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者を取得して配列へ
        $group_admin = GroupUser::where('group_id', $g_id)->where('group_admin', 1)->pluck('user_id');
        // ユーザー情報を取得
        $user = user::whereIn('id', $group_admin)->paginate($this->page);

        $param = [
            'items' => $user,
            'group_id' => $g_id,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin', $param);
    }

    public function addGroupAdmin(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を取得して配列へ
        $not_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 0)->pluck('user_id');
        // G管理者とM管理者以外の情報を取得
        $items = User::whereIn('id', $not_admin)->whereNotIn('is_admin', [1])->paginate($this->page);

        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin_add', $param);
    }

    // ---
    public function addGroupAdminAction(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $ses_get = $req->session()->get('group_id');

        GroupUser::where('group_id', $ses_get)->where('user_id', $u_id)->where('group_admin', 0)->update(['group_admin' => 1]);

        User::find($u_id)->update(['is_admin' => 2]);

        $req->session()->pull('group_id');

        return redirect('/admin/group_admin/done');
    }

    // delete group admin
    public function deleteGroupAdmin(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $user = User::find($u_id);
        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        $param = [
            "user" => $user,
            "user_id" => $user->id,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin.group_admin_delete', $param);
    }

    // ---
    public function deleteGroupAdminAction(UserRequest $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        $u_id = $req->user_id;

        $group_admin = GroupUser::where('user_id', $u_id)->where('group_admin', 1)->pluck('group_admin');
        $count = $group_admin->count();

        // is_adminが1以外かつ、他に管理するグループがなければis_adminを0へ変更
        $admin = User::find($u_id);
        if ($count <= 1 && $admin->is_admin != 1) {
            User::find($u_id)->update(['is_admin' => 0]);
        }

        GroupUser::where('group_id', $g_id)->where('user_id', $u_id)->where('group_admin', 1)->update(['group_admin' => 0]);

        $req->session()->pull('group_id');

        return redirect('/admin/delete/done');
    }

    // delete group
    public function delete(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        $group = Group::find($g_id);
        $ses_put = $req->session()->put('group_id', $g_id);

        $param = [
            'id' => $group->id,
            "group_name" => $group->group_name,
        ];
        return view('/admin.delete', $param);
    }

    // --- password check
    public function fort(Request $req)
    {
        $ses_get = $req->session()->get('group_id');
        return view('/admin.fort');
    }

    // ---
    public function deleteAction(UserRequest $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $ses_get = $req->session()->get('group_id');

        Group::find($ses_get)->delete();
        GroupUser::where('group_id', $ses_get)->delete();
        $req->session()->pull('group_id');

        return redirect('/admin/delete/done');
    }

    public function deletedGroup(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $group = Group::onlyTrashed()->paginate($this->page);

        $param = ['items' => $group];
        return view('/admin.group_deleted', $param);
    }

    // u show soft delete
    public function groupRestore(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        Group::onlyTrashed()->where('id', $g_id)->restore();

        return back();
    }

    /************
    --- group ---
    ************/

    // --- group ---
    public function groupIndex(Request $req)
    {
        if ($this->checkGroupAdmin() === 0 ) {
            return view('/admin.error');
        }
        $req->session()->pull('group_id');
        $a_id = Auth::user()->id;

        if (Auth::user()->is_admin == 2) {
            $admin_user = GroupUser::where('user_id', $a_id)->where('group_admin', 1)->pluck('group_id');
            $gu = Group::whereIn('id', $admin_user)->paginate($this->page);
        } else if (Auth::user()->is_admin == 1) {
            $gu = Group::paginate($this->page);
        }

        $param = ['items' => $gu];
        return view('/admin/group.index', $param);
    }

    // user list
    public function groupUser(Request $req)
    {
        if ($this->checkGroupAdmin() === 0 ) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;
        $user_list = Group::find($g_id)->user()->paginate($this->page);
        $group = Group::find($g_id);

        if (Auth::user()->is_admin != 1) {
            $u_id = Auth::id();
            $ga_id = GroupUser::where('user_id', $u_id)->where('group_admin', 1)->get();
            foreach ($ga_id as $ga) {
                if ($ga->group_id == $g_id) {
                    $param = [
                        'items' => $user_list,
                        'group_id' => $g_id,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.user', $param);
                }
            }
            return view('/admin.error');
        }

        $param = [
            'items' => $user_list,
            'group_id' => $g_id,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.user', $param);
    }

    /**
     * test method
     */
    public function checkGroup($g_id, $user_not, $ses_get, $group)
    {
        $u_id = Auth::id();
        $ga_id = GroupUser::where('user_id', $u_id)->where('group_admin', 1)->get();
        if (Auth::user()->is_admin != 1) {
            $u_id = Auth::id();
            $ga_id = GroupUser::where('user_id', $u_id)->where('group_admin', 1)->get();
            foreach ($ga_id as $ga) {
                if ($ga->group_id == $g_id) {
                    $param = [
                        'items' => $user_not,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.add', $param);
                }
            }
            return view('/admin.error');
        }
    }


    // add user
    public function addUser(Request $req)
    {
        if ($this->checkGroupAdmin() === 0 ) {
            return view('/admin.error');
        }
        $g_id = $req->group_id;

        $ses_put = $req->session()->put('group_id', $g_id);
        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        // groupsとusersを結合してグループに属するユーザーを取得して配列へ
        $user_in_group = Group::find($g_id)->user()->pluck('id');
        // グループに所属していないユーザー情報の取得
        $user_not = user::whereNotIn('id', $user_in_group)->paginate($this->page);


        if (Auth::user()->is_admin != 1) {
            $u_id = Auth::id();
            $ga_id = GroupUser::where('user_id', $u_id)->where('group_admin', 1)->get();
            foreach ($ga_id as $ga) {
                if ($ga->group_id == $g_id) {
                    $param = [
                        'items' => $user_not,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.add', $param);
                }
            }
            return view('/admin.error');
        }

        $param = [
            'items' => $user_not,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.add', $param);
    }

    // ---
    public function addAction(Request $req)
    {
        if ($this->checkGroupAdmin() === 0 ) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $ses_get = $req->session()->get('group_id');

        $gu = new GroupUser;
        $gu->user_id = $u_id;
        $gu->group_id = $ses_get;
        $gu->group_admin = 0;
        $gu->save();

        $req->session()->pull('group_id');

        return redirect('/admin/create/done');
    }
}
