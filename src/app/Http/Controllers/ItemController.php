<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Item;
use App\helpers;

use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * エラーページ
     *
     * @return void
     */
    public function error()
    {
        return view('/items.error');
    }

    /**
     * グループごとのアイテム一覧
     *
     * @return object
     */
    public function index(Request $req)
    {
        if (!helpers::checkInGroup($req->group_id)) {
            return redirect('items/error');
        }

        $group = Group::find($req->group_id);

        // ダイビング関連のグループかどうかを判定して取得するselectを選択
        $serch = Item::checkDivingGroup($group->group_type);

        // DBファサードは配列が返りpaginateが使えないため、rawを用いたクエリビルダで副問い合わせを作る
        $items = Item::getItemByGroup($serch, $req->group_id);

        $param = [
            'gid' => $req->group_id,
            'items' => $items,
            'group' => $group,
        ];

        return view('/items.index', $param);
    }

    /**
     * 日付ごとのアイテム一覧
     *
     * @return object
     */
    public function dateItems(Request $req)
    {
        // グループidが0の場合はエラーを返さずにチェックを通す
        if ($req->group_id != 0 && !helpers::checkInGroup($req->group_id)) {
            return redirect('items/error');
        }

        // グループIDの有無（グループまたは個人）の判定
        if ($req->group_id != 0) {
            $group = Group::find($req->group_id);
        } else {
            $group = null;
        }

        // グループIDのがなかった場合（個人）
        if (empty($group)) {
            $serch = DB::raw(Item::UnionAllNoGroup());
            // グループIDが存在する場合
        } else {
            $serch = Item::checkDivingGroup($group->group_type);
        }
        $uid = Auth::id();

        // グループとアイテムの条件に合わせて日別でレコードを取得
        $items = Item::selectUserDateItem($serch, $req->group_id, $req->item_type, $req->date, $uid);

        $param = [
            'date' => $req->date,
            'gid' => $req->group_id,
            'type' => $req->item_type,
            'items' => $items,
            'group' => $group,
        ];

        return view('/items.date_items', $param);
    }
}
