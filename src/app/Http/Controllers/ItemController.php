<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\Trip;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $a_id = Auth::id();
        $g_id = GroupUser::where('user_id', $a_id)->pluck('group_id');
        // $g_id = Trip::where('user_id', $a_id)->get();
        $group = Group::whereIn('id',$g_id)->get('group_name');

        $trip = Trip::where('user_id', $a_id)->get();

        // $trip = DB::table('trips as t')
        // ->join('group_user as gu', 't.user_id','gu.user_id')
        // // ->join('group_user', 'users.id','group_user.user_id')
        // ->join('groups as g', 'gu.group_id','g.id')
        // ->groupBy('t.id')
        // // ->where('trips.user_id',$a_id)
        // ->get();

        $param = [
            'items' => $trip,
            'g_id' => $g_id,
            'group' => $group,
            // 'user' => $users,
        ];
        dump($param);
        // return view('test',$trip);
        return view('/items.index', $param);
    }
}
