<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Trip;

class SortController extends Controller
{
    public $page = 7;
    /************
    --- AdminController ---
    ************/

    public function adminUser()
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        if (request()->path() == 'admin/user/sort_id_a') {
            $user = User::sortIdAsc();
        } else if (request()->path() == 'admin/user/sort_id_d') {
            $user = User::sortIdDesc();
        }

        if (request()->path() == 'admin/user/sort_name_a') {
            $user = User::sortNameAsc();
        } else if (request()->path() == 'admin/user/sort_name_d') {
            $user = User::sortNameDesc();
        }

        $param = [
            'items' => $user,
        ];
        return view('/admin.user', $param);
    }

    public function adminUserDeleted()
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        if (request()->path() == 'admin/user/deleted/sort_id_a') {
            $user = User::trashedSortIdAsc();
        } else if (request()->path() == 'admin/user/deleted/sort_id_d') {
            $user = User::trashedSortIdDesc();
        }

        if (request()->path() == 'admin/user/deleted/sort_name_a') {
            $user = User::trashedSortNameAsc();
        } else if (request()->path() == 'admin/user/deleted/sort_name_d') {
            $user = User::trashedSortNameDesc();
        }

        $param = [
            'items' => $user,
        ];
        return view('/admin.user_deleted', $param);
    }

    public function adminList()
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        if (request()->path() == 'admin/list/sort_id_a') {
            $group = Group::sortIdAsc();
        } else if (request()->path() == 'admin/list/sort_id_d') {
            $group = Group::sortIdDesc();
        }

        if (request()->path() == 'admin/list/sort_name_a') {
            $group = Group::sortNameAsc();
        } else if (request()->path() == 'admin/list/sort_name_d') {
            $group = Group::sortNameDesc();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin/list', $param);
    }

    public function adminGroupAdmin(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        $group_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 1)->pluck('user_id');

        if (request()->path() == 'admin/group_admin/sort_id_a') {
            $items = User::whereIn('id', $group_admin)->orderBy('id', 'asc')->paginate($this->page);
        } else if (request()->path() == 'admin/group_admin/sort_id_d') {
            $items = User::whereIn('id', $group_admin)->orderBy('id', 'desc')->paginate($this->page);
        }

        if (request()->path() == 'admin/group_admin/sort_name_a') {
            $items = User::whereIn('id', $group_admin)->orderBy('user_name', 'asc')->paginate($this->page);
        } else if (request()->path() == 'admin/group_admin/sort_name_d') {
            $items = User::whereIn('id', $group_admin)->orderBy('user_name', 'desc')->paginate($this->page);
        }


        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin', $param);
    }


    public function adminAddGroupAdmin(Request $req)
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を取得して配列へ
        $not_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 0)->pluck('user_id');
        // G管理者とM管理者以外の情報を取得


        if (request()->path() == 'admin/group_admin/add/sort_id_a') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('id', 'asc')->paginate($this->page);
        } else if (request()->path() == 'admin/group_admin/add/sort_id_d') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('id', 'desc')->paginate($this->page);
        }

        if (request()->path() == 'admin/group_admin/add/sort_name_a') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('user_name', 'asc')->paginate($this->page);
        } else if (request()->path() == 'admin/group_admin/add/sort_name_d') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('user_name', 'desc')->paginate($this->page);
        }


        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin_add', $param);
    }


    public function adminGroupDeleted()
    {
        if (Auth::user()->is_admin != 1) {
            return view('/admin.error');
        }

        if (request()->path() == 'admin/group/deleted/sort_id_a') {
            $group = Group::TrashedSortIdAsc();
        } else if (request()->path() == 'admin/group/deleted/sort_id_d') {
            $group = Group::TrashedSortIdDesc();
        }
        if (request()->path() == 'admin/group/deleted/sort_name_a') {
            $group = Group::TrashedSortNameAsc();
        } else if (request()->path() == 'admin/group/deleted/sort_name_d') {
            $group = Group::TrashedSortNameDesc();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin.group_deleted', $param);
    }

    public function group()
    {
        if (Auth::user()->is_admin != 1 && Auth::user()->is_admin != 2) {
            return view('/admin.error');
        }

        if (request()->path() == 'group/sort_id_a') {
            $group = Group::sortIdAsc();
        } else if (request()->path() == 'group/sort_id_d') {
            $group = Group::sortIdDesc();
        }

        if (request()->path() == 'group/sort_name_a') {
            $group = Group::sortNameAsc();
        } else if (request()->path() == 'group/sort_name_d') {
            $group = Group::sortNameDesc();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin/group.index', $param);
    }

    public function groupUserAdd(Request $req)
    {
        if (Auth::user()->is_admin != 1 && Auth::user()->is_admin != 2) {
            return view('/admin.error');
        }

        $ses_get = $req->session()->get('group_id');
        $group = Group::find($ses_get);

        $user_in_group = Group::find($ses_get)->user()->get();
        $plucked = $user_in_group->pluck('id');

        $user_not = user::whereNotIn('id', $plucked)->paginate($this->page);

        if (request()->path() == 'group/user/add/sort_id_a') {
            $user_not = user::whereNotIn('id', $plucked)->orderBy('id', 'asc')->paginate($this->page);
        } else if (request()->path() == 'group/user/add/sort_id_d') {
            $user_not = user::whereNotIn('id', $plucked)->orderBy('id', 'desc')->paginate($this->page);
        }

        if (request()->path() == 'group/user/add/sort_name_a') {
            $user_not = user::whereNotIn('id', $plucked)->orderBy('user_name', 'asc')->paginate($this->page);
        } else if (request()->path() == 'group/user/add/sort_name_d') {
            $user_not = user::whereNotIn('id', $plucked)->orderBy('user_name', 'desc')->paginate($this->page);
        }

        $param = [
            'items' => $user_not,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.add', $param);
    }

    /************
    --- TrripController ---
    ************/
    public function itemIndex()
    {
        if (request()->path() == 'trips/sort_title_a') {
            $trip = Trip::sortTitleAsc();
        } else if (request()->path() == 'trips/sort_title_d') {
            $trip = Trip::sortTitleDesc();
        }

        if (request()->path() == 'trips/sort_date_a') {
            $trip = Trip::sortDateAsc();
        } else if (request()->path() == 'trips/sort_date_d') {
            $trip = Trip::sortDateDesc();
        }

        if (request()->path() == 'trips/sort_user_a') {
            // $trip = Trip::sortUserAsc();
            $new = new Trip;
            $trip = $new->user()->orderBy('user_name')->paginate(7);
        } else if (request()->path() == 'trips/sort_user_d') {
            $trip = Trip::sortUserDesc();
        }

        $param = [
            'items' => $trip,
        ];
        return view('/trips.index', $param);
    }
    // return view('/test');
}
