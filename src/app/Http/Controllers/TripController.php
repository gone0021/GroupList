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

class TripController extends Controller
{
    public function index(Request $req)
    {
        $req->session()->put('item_type', $req->item_type);
        $ses_get = session()->get('item_type');

        $a_id = Auth::id();
        $trip = Trip::where('user_id', $a_id)->get();

        // $g_id = GroupUser::where('user_id', $a_id)->pluck('group_id');

        $param = [
            'items' => $trip,
            // 'g_id' => $g_id,
            'ses_item_type' => $ses_get,
        ];
        // dump($param);
        // return view('test',$trip);
        return view('/item_list/trips.index', $param);
    }


    /**
     * 状態の編集
     *
     * @param Request $req
     * @return void
     */
    public function status(Request $req)
    {
        $trip = Trip::find($req->trip_id);

        if ($trip->is_went !== 0) {
            Trip::find($req->trip_id)->update(['is_went' => 0]);
            return back();
        } else {
            Trip::find($req->trip_id)->update(['is_went' => 1]);
            return back();
        }
    }


    /**
     * 編集ページ
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        $ses_get = session()->get('item_type');
        $items = Trip::find($req->trip_id)->get();

        $param = [
            'items' => $items,
            'ses_item_type' => $ses_get,
        ];
        return view('/item_list/trips.edit', $param);
    }

    /**
     * グループ編集
     * 実行
     *
     * @param Request $req
     * @return void
     */
    public function groupUpdate(GroupRequest $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $group = Trip::find($req->id);
        $group->fill($val)->update();

        return redirect('/admin/edit/done');
    }

}


