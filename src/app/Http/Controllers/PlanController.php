<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\Plan;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * アイテムページ
     *
     * @return void
     */
    public function index()
    {

        $a_id = Auth::id();
        $g_id = GroupUser::where('user_id', $a_id)->pluck('group_id');
        // $g_id = Trip::where('user_id', $a_id)->get();
        $group = Group::whereIn('id', $g_id)->get('group_name');

        $items = Plan::where('user_id', $a_id)->get();

        $param = [
            'items' => $items,
            'g_id' => $g_id,
            'group' => $group,
            // 'user' => $users,
        ];
        dump($param);
        // return view('test',$trip);
        return view('/items.index', $param);
    }


}
