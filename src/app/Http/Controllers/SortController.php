<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Trip;
use App\Models\Plan;
use App\Models\Divelog;
use App\helpers;

class SortController extends Controller
{
    public $page = 7;
    /************************\
    --- AdminController ---
    \************************/

    /**
     * ユーザー一覧
     *
     * @return void
     */
    public function adminUser()
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
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

    /**
     * 削除済ユーザー
     *
     * @return void
     */
    public function adminUserDeleted()
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
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

    /**
     * グループ一覧
     *
     * @return void
     */
    public function adminList()
    {
        if (!helpers::checkAdmin()) {
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

    /**
     * グループ管理者一覧
     *
     * @return void
     */
    public function adminGroupAdmin(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return view('/admin.error');
        }

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        $group_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 1)->pluck('user_id');

        if (request()->path() == 'admin/group_admin/sort_id_a') {
            $items = User::whereIn('id', $group_admin)->orderBy('id', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'admin/group_admin/sort_id_d') {
            $items = User::whereIn('id', $group_admin)->orderBy('id', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'admin/group_admin/sort_name_a') {
            $items = User::whereIn('id', $group_admin)->orderBy('user_name', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'admin/group_admin/sort_name_d') {
            $items = User::whereIn('id', $group_admin)->orderBy('user_name', 'desc')->paginate(helpers::$page);
        }


        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin', $param);
    }


    /**
     * グループ管理者の追加
     *
     * @return void
     */
    public function adminAddGroupAdmin(Request $req)
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
            return view('/admin.error');
        }

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を取得して配列へ
        $not_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 0)->pluck('user_id');
        // G管理者とM管理者以外の情報を取得


        if (request()->path() == 'admin/group_admin/add/sort_id_a') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('id', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'admin/group_admin/add/sort_id_d') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('id', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'admin/group_admin/add/sort_name_a') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('user_name', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'admin/group_admin/add/sort_name_d') {
            $items = User::whereNotIn('id', $not_admin)->whereNotIn('is_admin', [1])->orderBy('user_name', 'desc')->paginate(helpers::$page);
        }


        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin_add', $param);
    }


    /**
     * 削除済グループ
     *
     * @return void
     */
    public function adminGroupDeleted()
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
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

    /**
     * 管理グループ一覧
     *
     * @return void
     */
    public function group()
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
            // if (Auth::user()->is_admin != 1 && Auth::user()->is_admin != 2) {
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

    /**
     * 管理グループ
     * 参加者一覧
     *
     * @return void
     */
    public function groupUser(Request $req)
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
            return view('/admin.error');
        }

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        $user_in_group = Group::find($ses_get)->user()->get();
        $plucked = $user_in_group->pluck('id');

        if (request()->path() == 'group/user/sort_id_a') {
            $items = user::whereIn('id', $plucked)->orderBy('id', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'group/user/sort_id_d') {
            $items = user::whereIn('id', $plucked)->orderBy('id', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'group/user/sort_name_a') {
            $items = user::whereIn('id', $plucked)->orderBy('user_name', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'group/user/sort_name_d') {
            $items = user::whereIn('id', $plucked)->orderBy('user_name', 'desc')->paginate(helpers::$page);
        }

        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.user', $param);
    }

    /**
     * 管理グループ
     * ユーザーの追加
     *
     * @return void
     */
    public function groupUserAdd(Request $req)
    {
        $admin = new AdminController;
        if (!helpers::checkAdmin()) {
            return view('/admin.error');
        }

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        $user_in_group = Group::find($ses_get)->user()->get();
        $plucked = $user_in_group->pluck('id');

        if (request()->path() == 'group/user/add/sort_id_a') {
            $items = user::whereNotIn('id', $plucked)->orderBy('id', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'group/user/add/sort_id_d') {
            $items = user::whereNotIn('id', $plucked)->orderBy('id', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'group/user/add/sort_name_a') {
            $items = user::whereNotIn('id', $plucked)->orderBy('user_name', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'group/user/add/sort_name_d') {
            $items = user::whereNotIn('id', $plucked)->orderBy('user_name', 'desc')->paginate(helpers::$page);
        }

        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.add', $param);
    }

    /************************\
    --- TripController ---
    \************************/

    /**
     * 個人_Trip
     *
     * @return void
     */
    public function tripIndex()
    {
        if (request()->path() == 'trips/sort_title_a') {
            $items = Trip::where('user_id', Auth::id())->orderBy('title', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'trips/sort_title_d') {
            $items = Trip::where('user_id', Auth::id())->orderBy('title', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'trips/sort_date_a') {
            $items = Trip::where('user_id', Auth::id())->orderBy('date', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'trips/sort_date_d') {
            $items = Trip::where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(helpers::$page);
        }

        $param = [
            'items' => $items,
        ];
        return view('/items/trips.index', $param);
    }

    /**
     * 個人_Trip
     *
     * @return void
     */
    public function tripDeleted()
    {
        if (request()->path() == 'trips/deleted/sort_title_a') {
            $items = Trip::trashedSortNameAsc();
        } else if (request()->path() == 'trips/deleted/sort_title_d') {
            $items = Trip::trashedSortNameDesc();
        }

        if (request()->path() == 'trips/deleted/sort_date_a') {
            $items = Trip::trashedSortDateAsc();
        } else if (request()->path() == 'trips/deleted/sort_date_d') {
            $items = Trip::trashedSortDateDesc();
        }

        $param = [
            'items' => $items,
        ];
        return view('/items/trips.deleted', $param);
    }

    /************************\
    --- PlnaController ---
    \************************/

    /**
     * 個人_Plan
     *
     * @return void
     */
    public function planIndex()
    {
        if (request()->path() == 'plans/sort_title_a') {
            $items = Plan::where('user_id', Auth::id())->orderBy('title', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'plans/sort_title_d') {
            $items = Plan::where('user_id', Auth::id())->orderBy('title', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'plans/sort_start_a') {
            $items = Plan::where('user_id', Auth::id())->orderBy('start', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'plans/sort_start_d') {
            $items = Plan::where('user_id', Auth::id())->orderBy('start', 'desc')->paginate(helpers::$page);
        }

        $param = ['items' => $items,];
        return view('/items/plans.index', $param);
    }

    /**
     * 個人_Plan
     *
     * @return void
     */
    public function planDeleted()
    {
        if (request()->path() == 'plans/deleted/sort_title_a') {
            $items = Plan::trashedSortNameAsc();
        } else if (request()->path() == 'plans/deleted/sort_title_d') {
            $items = Plan::trashedSortNameDesc();
        }

        if (request()->path() == 'plans/deleted/sort_start_a') {
            $items = Plan::trashedSortStartAsc();
        } else if (request()->path() == 'plans/deleted/sort_start_d') {
            $items = Plan::trashedSortStartDesc();
        }

        $param = ['items' => $items,];
        return view('/items/plans.deleted', $param);
    }


    /************************\
    ---DivelogController ---
    \************************/

    /**
     * 個人：Divelog
     *
     * @return void
     */
    public function divelogIndex()
    {
        if (request()->path() == 'divelogs/sort_title_a') {
            $items = Divelog::where('user_id', Auth::id())->orderBy('title', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'divelogs/sort_title_d') {
            $items = Divelog::where('user_id', Auth::id())->orderBy('title', 'desc')->paginate(helpers::$page);
        }

        if (request()->path() == 'divelogs/sort_date_a') {
            $items = Divelog::where('user_id', Auth::id())->orderBy('date', 'asc')->paginate(helpers::$page);
        } else if (request()->path() == 'divelogs/sort_date_d') {
            $items = Divelog::where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(helpers::$page);
        }

        $param = ['items' => $items,];
        return view('/items/divelogs.index', $param);
    }

    /**
     * 個人：Divelog：削除済
     *
     * @return void
     */
    public function divelogDeleted()
    {
        if (request()->path() == 'divelogs/deleted/sort_title_a') {
            $items = Divelog::trashedSortNameAsc();
        } else if (request()->path() == 'divelogs/deleted/sort_title_d') {
            $items = Divelog::trashedSortNameDesc();
        }

        if (request()->path() == 'divelogs/deleted/sort_date_a') {
            $items = Divelog::trashedSortDateAsc();
        } else if (request()->path() == 'divelogs/deleted/sort_date_d') {
            $items = Divelog::trashedSortDateDesc();
        }

        $param = ['items' => $items,];
        return view('/items/divelogs.deleted', $param);
    }

    // return view('/test');
}
