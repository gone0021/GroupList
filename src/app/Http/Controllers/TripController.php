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
    /** ぺジネーションの数 */
    private $page = 7;

    public function index(Request $req)
    {
        $a_id = Auth::id();
        $trip = Trip::where('user_id', $a_id)->paginate($this->page);
        $param = ['items' => $trip,];
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
        $trip = Trip::find($req->id);

        if ($trip->is_went != 0) {
            Trip::find($req->id)->update(['is_went' => 0]);
            return back();
        } else {
            Trip::find($req->id)->update(['is_went' => 1]);
            return back();
        }
    }

    /** 新規登録 */
    public function new()
    {
        return view('/item_list/trips.new');
    }

    /**
     * 新規登録_確認
     *
     * @param Request $req
     * @return void
     */
    public function newCheck(Request $req)
    {
        $this->validate($req, Trip::$rules, Trip::$messages);

        $items = $req->all();
        $param = ['items' => $items,];
        return view('/item_list/trips.new_check', $param);
    }

    /** 新規登録_実行
     *
     * @param Request $req
     * @return void
     */
    public function newCreate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $trip = new Trip;
        $trip->fill($val)->save();
        return redirect('/trips/new/done');
    }

    /**
     * 編集
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        $items = Trip::find($req->id);
        $param = ['items' => $items,];
        return view('/item_list/trips.edit', $param);
    }

    /**
     * 編集_確認
     *
     * @param Request $req
     * @return void
     */
    public function editCheck(Request $req)
    {
        // $this->validate($req, Trip::$rules, Trip::$messages);
        $items = $req->all();
        $param = ['items' => $items,];
        return view('/item_list/trips.edit_check', $param);
    }

    /**
     * 編集_実行
     *
     * @param Request $req
     * @return void
     */
    public function tripUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $trip = Trip::find($req->id);
        $trip->fill($val)->update();
        return redirect('/trips/edit/done');
    }
}
