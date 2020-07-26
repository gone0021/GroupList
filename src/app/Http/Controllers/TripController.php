<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
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
        // dump($param);
        return view('/items/trips.index', $param);
    }

    /**
     * 詳細
     *
     * @param Request $req
     * @return void
     */
    public function detailTrip(Request $req)
    {
        $items = Trip::find($req->id);
        $param = ['items' => $items,];
        // dump($req->id);
        return view('/items/trips.detail', $param);
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

        if ($trip->status != 0) {
            Trip::find($req->id)->update(['status' => 0]);
            return back();
        } else {
            Trip::find($req->id)->update(['status' => 1]);
            return back();
        }
    }

    /** 新規登録 */
    public function new()
    {
        return view('/items/trips.new');
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
        return view('/items/trips.new_check', $param);
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
        return view('/items/trips.edit', $param);
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
        return view('/items/trips.edit_check', $param);
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

    /**
     * 削除_確認
     *
     * @param Request $req
     * @return void
     */
    public function delete(Request $req)
    {
        $items = Trip::find($req->id);
        $param = ['items' => $items,];
        return view('/items/trips.delete', $param);
    }

    /**
     * 削除_実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteAction(Request $req)
    {
        Trip::find($req->id)->delete();
        // dump($req->id);
        // return view('test');
        return redirect('/trips/delete/done');
    }


    /**
     * 削除済アイテムの表示
     *
     * @return void
     */
    public function deletedTrip()
    {
        $teims = Trip::onlyTrashed()->paginate($this->page);

        $param = ['items' => $teims];
        // dump($param);
        return view('/items/trips.deleted', $param);
    }

    /**
     * 削除済アイテムの復元
     *
     * @param Request $req
     * @return void
     */
    public function tripRestore(Request $req)
    {
        Trip::onlyTrashed()->where('id', $req->id)->restore();
        return back();
    }

    /**
     * 削除済_詳細
     *
     * @param Request $req
     * @return void
     */
    public function deletedDetailTrip(Request $req)
    {
        $items = Trip::onlyTrashed()->find($req->id);
        $param = ['items' => $items,];
        dump($req->id);
        return view('/items/trips.detail', $param);
    }
}
