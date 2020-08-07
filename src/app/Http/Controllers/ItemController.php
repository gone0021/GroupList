<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\Trip;
use App\Models\Plan;
use App\Models\Divelog;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\New_;

class ItemController extends Controller
{
    public $p_num = 7;
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
     * アイテム一覧
     *
     * @return object
     */
    public function index(Request $req)
    {
        if (!$this->checkInGroup($req->group_id)) {
            return redirect('items/error');
        }

        $group = Group::find($req->group_id);

        if ($group->group_type == 0) {
            $serch = DB::raw(Item::UnionNoDivelog());
        } else if ($group->group_type == 1) {
            $serch = DB::raw(Item::UnionAll());
        }

        // DBファサードは配列が返りpaginateが使えないため、rawを用いたクエリビルダで副問い合わせを作る
        $items = DB::table($serch)
            ->select($this->select)
            ->where('g.id', $req->group_id)
            ->paginate($this->p_num);

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
        if ($req->group_id != 0 && !$this->checkInGroup($req->group_id)) {
            // if (!$this->checkInGroup($req->group_id)) {
            return redirect('items/error');
        }

        // グループIDの有無
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
            if ($group->group_type == 0) {
                $serch = DB::raw(Item::UnionNoDivelog());
            } else if ($group->group_type == 1) {
                $serch = DB::raw(Item::UnionAll());
            }
        }

        // group_idあり、item_typeあり
        if ($req->group_id > 0 && $req->item_type > 0) {
            $items = DB::table($serch)
                // ->Item::DateItemGroupByType($req->date)
                ->select($this->select)
                ->where('g.id', $req->group_id)
                ->where('item_type', $req->item_type)
                ->where('date', $req->date)
                ->whereNull('is_deleted')
                ->paginate($this->p_num);

            // group_idあり、item_typeなし
        } elseif ($req->group_id > 0 && $req->item_type == 0) {
            $items = DB::table($serch)
                // ->Item::DateItemGroupAllType($req->date)
                ->select($this->select)
                ->where('g.id', $req->group_id)
                ->where('date', $req->date)
                ->whereNull('is_deleted')
                ->paginate($this->p_num);

            // group_idなし、item_typeあり
        } elseif ($req->group_id == 0 && $req->item_type > 0) {
            $items = DB::table($serch)
                // ->Item::DateItemPersonByType($req->date)
                ->select($this->select)
                ->where('item_type', $req->item_type)
                ->where('date', $req->date)
                ->whereNull('is_deleted')
                ->paginate($this->p_num);

            // group_idなし、item_typeなし
        } elseif ($req->group_id == 0 && $req->item_type == 0) {
            $items = DB::table($serch)
                // ->Item::DateItemPersonAllType($req->date)
                ->select($this->select)
                ->where('date', $req->date)
                ->whereNull('is_deleted')
                ->paginate($this->p_num);
        }

        $param = [
            'gid' => $req->group_id,
            'items' => $items,
            'group' => $group,
        ];

        return view('/items.date_items', $param);
    }


    /**
     * グループに参加しているかチェック
     *
     * @return boolean
     */
    public function checkInGroup($group_id): bool
    {
        $a_id = Auth::id();
        $group = User::find($a_id)->group()->get()->toArray();
        $res = false;

        foreach ($group as $g) {
            // if ( $group_id == 0) {
            //     $res = true;
            //     break;
            // }
            if (empty($g['id'] == $group_id)) {
                $res = false;
            } else {
                $res = true;
                break;
            }
        }
        return $res;
    }
}
