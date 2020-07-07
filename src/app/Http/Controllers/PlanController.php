<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /** ぺジネーションの数 */
    private $page = 7;

    public function index(Request $req)
    {
        $a_id = Auth::id();
        $plan = Plan::where('user_id', $a_id)->paginate($this->page);

        $param = ['items' => $plan,];
        return view('/item_list/plans.index', $param);
    }

    /**
     * 詳細
     *
     * @param Request $req
     * @return void
     */
    public function detailPlan(Request $req)
    {
        $items = Plan::find($req->id);
        $param = ['items' => $items,];
        // dump($req->id);
        return view('/item_list/plans.detail', $param);
    }

    /**
     * 状態の編集
     *
     * @param Request $req
     * @return void
     */
    public function status(Request $req)
    {
        $plan = Plan::find($req->id);

        if ($plan->status != 0) {
            Plan::find($req->id)->update(['status' => 0]);
            return back();
        } else {
            Plan::find($req->id)->update(['status' => 1]);
            return back();
        }
    }

    /** 新規登録 */
    public function new()
    {
        return view('/item_list/plans.new');
    }

    /**
     * 新規登録_確認
     *
     * @param Request $req
     * @return void
     */
    public function newCheck(Request $req)
    {
        $this->validate($req, Plan::$rules, Plan::$messages);

        $items = $req->all();
        $param = ['items' => $items,];
        dump($param);
        return view('/item_list/plans.new_check', $param);
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

        $plan = new Plan;
        $plan->fill($val)->save();
        return redirect('/plans/new/done');
    }

    /**
     * 編集
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        $items = Plan::find($req->id);
        $param = ['items' => $items,];
        // dump(strtotime($items->start));
        // dump($items->start);
        return view('/item_list/plans.edit', $param);
    }

    /**
     * 編集_確認
     *
     * @param Request $req
     * @return void
     */
    public function editCheck(Request $req)
    {
        // $this->validate($req, Plan::$rules, Plan::$messages);
        $items = $req->all();
        $param = ['items' => $items,];
        return view('/item_list/plans.edit_check', $param);
    }

    /**
     * 編集_実行
     *
     * @param Request $req
     * @return void
     */
    public function planUpdate(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $plan = Plan::find($req->id);
        $plan->fill($val)->update();
        return redirect('/plans/edit/done');
    }

    /**
     * 削除_確認
     *
     * @param Request $req
     * @return void
     */
    public function delete(Request $req)
    {
        $items = Plan::find($req->id);
        $param = ['items' => $items,];
        return view('/item_list/plans.delete', $param);
    }

    /**
     * 削除_実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteAction(Request $req)
    {
        Plan::find($req->id)->delete();
        // dump($req->id);
        // return view('test');
        return redirect('/plans/delete/done');
    }


    /**
     * 削除済アイテムの表示
     *
     * @return void
     */
    public function deletedPlan()
    {
        $teims = Plan::onlyTrashed()->paginate($this->page);

        $param = ['items' => $teims];
        // dump($param);
        return view('/item_list/plans.deleted', $param);
    }

    /**
     * 削除済アイテムの復元
     *
     * @param Request $req
     * @return void
     */
    public function planRestore(Request $req)
    {
        Plan::onlyTrashed()->where('id', $req->id)->restore();
        return back();
    }

    /**
     * 削除済_詳細
     *
     * @param Request $req
     * @return void
     */
    public function deletedDetailPlan(Request $req)
    {
        $items = Plan::onlyTrashed()->find($req->id);
        $param = ['items' => $items,];
        dump($req->id);
        return view('/item_list/plans.detail', $param);
    }
}
