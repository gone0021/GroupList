<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Divelog;
use App\helpers;

class DivelogController extends Controller
{
    /**
     * divelogページ
     *
     * @return void
     */
    public function index()
    {
        $items = Divelog::where('user_id', Auth::id())->paginate(helpers::$page);
        $param = ['items' => $items,];
        return view('/items/divelogs.index', $param);
    }

    /**
     * 詳細ページ
     *
     * @param Request $req
     * @return void
     */
    public function detailDivelog(Request $req)
    {
        $items = Divelog::find($req->id);
        $param = ['items' => $items,];
        return view('/items/divelogs.detail', $param);
    }

    /** 新規登録 */
    public function new()
    {
        $val = Divelog::orderBy('dive_num', 'desc')->value('dive_num');
        $param = ['val' => $val,];
        return view('/items/divelogs.new', $param);
    }

    /**
     * 新規登録：確認
     *
     * @param Request $req
     * @return void
     */
    public function newCheck(Request $req)
    {
        $this->validate($req, Divelog::$rules, Divelog::$messages);
        $items = $req->all();
        $param = ['items' => $items,];
        return view('/items/divelogs.new_check', $param);
    }

    /** 新規登録：実行
     *
     * @param Request $req
     * @return void
     */
    public function newCreate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $divelog = new Divelog;
        $divelog->fill($val)->save();
        return redirect('/divelogs/new/done');
    }

    /**
     * 編集
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        $items = Divelog::find($req->id);
        $param = ['items' => $items,];
        return view('/items/divelogs.edit', $param);
    }

    /**
     * 編集：確認
     *
     * @param Request $req
     * @return void
     */
    public function editCheck(Request $req)
    {
        // $this->validate($req, Divelog::$rules, Divelog::$messages);
        $items = $req->all();
        $param = ['items' => $items,];
        return view('/items/divelogs.edit_check', $param);
    }

    /**
     * 編集：実行
     *
     * @param Request $req
     * @return void
     */
    public function divelogUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $divelog = Divelog::find($req->id);
        $divelog->fill($val)->update();
        return redirect('/divelogs/edit/done');
    }

    /**
     * 削除：確認
     *
     * @param Request $req
     * @return void
     */
    public function delete(Request $req)
    {
        $items = Divelog::find($req->id);
        $param = ['items' => $items,];
        return view('/items/divelogs.delete', $param);
    }

    /**
     * 削除：実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteAction(Request $req)
    {
        Divelog::find($req->id)->delete();
        return redirect('/divelogs/delete/done');
    }


    /**
     * 削除済アイテムの表示
     *
     * @return void
     */
    public function deletedDivelog()
    {
        $teims = Divelog::onlyTrashed()->paginate(helpers::$page);
        $param = ['items' => $teims];
        return view('/items/divelogs.deleted', $param);
    }

    /**
     * 削除済アイテムの復元
     *
     * @param Request $req
     * @return void
     */
    public function divelogRestore(Request $req)
    {
        Divelog::onlyTrashed()->where('id', $req->id)->restore();
        return back();
    }

    /**
     * 削除済：詳細
     *
     * @param Request $req
     * @return void
     */
    public function deletedDetailDivelog(Request $req)
    {
        $items = Divelog::onlyTrashed()->find($req->id);
        $param = ['items' => $items,];
        return view('/items/divelogs.detail', $param);
    }
}
