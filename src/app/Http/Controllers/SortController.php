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

class SortController extends Controller
{
    public function adminUser()
    {
        if (request()->path() == 'admin/user/sort_id') {
            $user = User::sortId();
        } else if (request()->path() == 'admin/user/sort_name') {
            $user = User::sortName();
        }

        $param = [
            'items' => $user,
        ];
        return view('/admin.user', $param);
    }

    public function adminUserDeleted()
    {
        if (request()->path() == 'admin/user/deleted/sort_id') {
            $user = User::trashedSortId();
        } else if (request()->path() == 'admin/user/deleted/sort_name') {
            $user = User::trashedSortName();
        }

        $param = [
            'items' => $user,
        ];
        return view('/admin.user_deleted', $param);
    }

    public function adminList()
    {
        if (request()->path() == 'admin/list/sort_id') {
            $group = Group::sortId();
        } else if (request()->path() == 'admin/list/sort_name') {
            $group = Group::sortName();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin/list', $param);
    }

    public function group()
    {
        if (request()->path() == 'group/sort_id') {
            $group = Group::sortId();
        } else if (request()->path() == 'group/sort_name') {
            $group = Group::sortName();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin/group.index', $param);
    }

    public function groupUserAdd(Request $req)
    {
        if (request()->path() == 'group/user/add/sort_id') {
            $group = User::sortId();
        } else if (request()->path() == 'group/user/add/sort_name') {
            $group = User::sortName();
        }

        $param = [
            'items' => $group,
        ];
        dump($param);
        return view('/admin/group.add', $param);
    }

    public function adminGroupDeleted()
    {
        if (request()->path() == 'admin/group/deleted/sort_id') {
            $group = Group::trashedSortId();
        } else if (request()->path() == 'admin/group/deleted/sort_name') {
            $group = Group::trashedSortName();
        }

        $param = [
            'items' => $group,
        ];
        return view('/admin.group_deleted', $param);
    }

    // return view('/test');
}
