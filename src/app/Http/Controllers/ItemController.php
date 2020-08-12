<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group;
use App\Models\Item;
use App\helpers;

use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    // select条件
    public $select = ["item_id", "group_name", "item_type", "title", "date", "uid", "user_name", "status", "open_range", "is_open"];

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

        // ダイビング関連のグループかどうかを判定
        $serch = self::checkDivingGroup($group->group_type);

        // DBファサードは配列が返りpaginateが使えないため、rawを用いたクエリビルダで副問い合わせを作る
        $items = $this->getItemByGroup($serch, $req->group_id);

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
        // グループidが0の場合はエラーを返さない
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
            $serch = self::checkDivingGroup($group->group_type);
        }

        // グループとアイテムの条件に合わせて日別でレコードを取得
        $items = $this->selectUserDateItem($serch, $req->group_id, $req->item_type, $req->date);

        $param = [
            'gid' => $req->group_id,
            'items' => $items,
            'group' => $group,
        ];

        return view('/items.date_items', $param);
    }


    /**
     * グループ別にレコードを取得
     */
    public function getItemByGroup($serch, $group_id)
    {
        $items = DB::table($serch)
            ->select($this->select)
            ->where('g.id', $group_id)
            ->whereNull('is_deleted')
            ->paginate(helpers::$page);
        return $items;
    }

    /**
     * ダイビング関連のグループかどうかを判定
     */
    public static function checkDivingGroup($group_type)
    {
        if ($group_type == 0) {
            $serch = DB::raw(Item::UnionNoDivelog());
        } else if ($group_type == 1) {
            $serch = DB::raw(Item::UnionAll());
        }
        return $serch;
    }

    /**
     * グループとアイテムの条件に合わせて日別でレコードを取得
     */
    public function selectUserDateItem($serch, $group_id, $item_type, $date)
    {
        // グループ別：タイプ別
        if ($group_id != 0 && $item_type != 0) {
            $items = $this->getDateItemGroupByType($serch, $group_id, $item_type, $date);

            // グループ別：全タイプ
        } elseif ($group_id != 0 && $item_type == 0) {
            $items = $this->getDateItemGroupAllType($serch, $group_id, $date);

            // 個人：タイプ別
        } elseif ($group_id == 0 && $item_type != 0) {
            $items = $this->getDateItemPersonByType($serch, $item_type, $date);

            // 個人：全タイプ
        } elseif ($group_id == 0 && $item_type == 0) {
            $items = $this->getDateItemPersonAllType($serch, $date);
        }
        return $items;
    }

    /**
     * 日別でレコードを取得
     * グループ別：タイプ別
     */
    public function getDateItemGroupByType($serch, $group_id, $item_type, $date)
    {
        $items = DB::table($serch)
            ->select($this->select)
            ->where('g.id', $group_id)
            ->where('item_type', $item_type)
            ->where('date', $date)
            ->whereNull('is_deleted')
            ->paginate(helpers::$page);
        return $items;
    }

    /**
     * 日別でレコードを取得
     * グループ別：全タイプ
     */
    public function getDateItemGroupAllType($serch, $group_id, $date)
    {
        $items = DB::table($serch)
            ->select($this->select)
            ->where('g.id', $group_id)
            ->where('date', $date)
            ->whereNull('is_deleted')
            ->paginate(helpers::$page);
        return $items;
    }

    /**
     * 日別でレコードを取得
     * 個人：タイプ別
     */
    public function getDateItemPersonByType($serch, $item_type, $date)
    {
        $items = DB::table($serch)
            ->select($this->select)
            ->where('item_type', $item_type)
            ->where('date', $date)
            ->whereNull('is_deleted')
            ->paginate(helpers::$page);
        return $items;
    }

    /**
     * 日別でレコードを取得
     * 個人：全タイプ
     */
    public function getDateItemPersonAllType($serch, $date)
    {
        $items = DB::table($serch)
            ->select($this->select)
            ->where('date', $date)
            ->whereNull('is_deleted')
            ->paginate(helpers::$page);
        return  $items;
    }
}
