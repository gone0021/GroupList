<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\DiveLog;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * DiveLogのアイテム一覧
     * 
     * 
     * 
     */
    public function index(Request $req)
    {
        $a_id = Auth::id();

        $group = Group::find($req->group_id)->get();

        $trip = DiveLog::find($req->trip_id)->get();

        $param = [
            'items' => $trip,
            'group' => $group,
        ];
        dump($param);
        // return view('test',$trip);
        return view('/items.index', $param);
    }
}
