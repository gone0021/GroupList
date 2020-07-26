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
    public function index(Request $req)
    {
        $group = Group::find($req->group_id);

        if ($group->group_type == 0) {
            $serch = DB::raw(Item::UnionNoDivelog());
        } else if ($group->group_type == 1) {
            $serch = DB::raw(Item::UnionAll());
        }

        // DBファサードは配列が返りpaginateが使えないため、rawを用いたクエリビルダで副問い合わせを作る
        $items = DB::table($serch)
            ->select("item_id", "group_name", "item_type", "title", "date", "user_name", "status", "open_range", "is_open")
            ->where('g.id', $req->group_id)
            ->paginate(7);

        $param = [
            'gid' => $req->group_id,
            'items' => $items,
            'group' => $group,
        ];

        return view('/items.index', $param);
    }

}
