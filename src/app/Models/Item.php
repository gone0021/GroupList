<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    // 共通のselect条件
    public static $select = ["item_id", "group_name", "item_type", "title", "date", "uid", "user_name", "status", "open_range", "is_open"];

    public function scopeSortIdAsc()
    {
        $sort = $this->orderBy('id', 'asc')->paginate($this->p_num);
        return $sort;
    }
    public function scopeSortIdDesc()
    {
        $sort = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $sort;
    }

    /**
     * unon 全てのアイテム
     */
    public function scopeUnionAll()
    {
        return
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        UNION
        SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open, deleted_at as is_deleted
        FROM dive_logs as d
        )
        JOIN users as u ON uid = u.id
        JOIN group_user as gu ON u.id = gu.user_id
        JOIN groups as g ON gu.group_id = g.id
        ';
    }

    /**
     * unon dive_logs以外のアイテム
     */
    public function scopeUnionNoDivelog()
    {
        return
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        )
        JOIN users as u ON uid = u.id
        JOIN group_user as gu ON u.id = gu.user_id
        JOIN groups as g ON gu.group_id = g.id
        ';
    }

    /**
     * unon 全てのアイテム、かつグループとのjoinなし
     */
    public function scopeUnionAllNoGroup()
    {
        return
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        UNION
        SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open, deleted_at as is_deleted
        FROM dive_logs as d
        )
        JOIN users as u ON uid = u.id
        ';
    }


    /**
     * unon dive_logs以外のアイテム、かつグループなし
     * 未使用（予備）
     */
    public function scopeUnionNoDivelogNoGroup()
    {
        return
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        )
        JOIN users as u ON uid = u.id
        ';
    }

    /**
     * グループ別にレコードを取得
     */
    public static function getItemByGroup($serch, $group_id)
    {
        $items = DB::table($serch)
            ->select(self::$select)
            ->where('g.id', $group_id)
            ->whereNull('is_deleted');
        return $items;
    }

    /**
     * ダイビング関連のグループかどうかを判定
     */
    public static function checkDivingGroup($group_type)
    {
        if ($group_type == 0) {
            $serch = DB::raw(self::UnionNoDivelog());
        } else if ($group_type == 1) {
            $serch = DB::raw(self::UnionAll());
        }
        return $serch;
    }

    /**
     * グループとアイテムの条件に合わせて日別でレコードを取得
     */
    public static function selectUserDateItem($serch, $group_id, $item_type, $date, $uid)
    {
        // グループ別：タイプ別
        if ($group_id != 0 && $item_type != 0) {
            $items = self::getDateItemGroupByType($serch, $group_id, $item_type, $date);

            // グループ別：全タイプ
        } elseif ($group_id != 0 && $item_type == 0) {
            $items = self::getDateItemGroupAllType($serch, $group_id, $date);

            // 個人：タイプ別
        } elseif ($group_id == 0 && $item_type != 0) {
            $items = self::getDateItemPersonByType($serch, $item_type, $date, $uid);

            // 個人：全タイプ
        } elseif ($group_id == 0 && $item_type == 0) {
            $items = self::getDateItemPersonAllType($serch, $date, $uid);
        }
        return $items;
    }

    /**
     * 日別でレコードを取得
     * グループ別：タイプ別
     */
    public static function getDateItemGroupByType($serch, $group_id, $item_type, $date)
    {
        $items = DB::table($serch)
            ->select(self::$select)
            ->where('g.id', $group_id)
            ->where('item_type', $item_type)
            ->where('date', $date)
            ->whereNull('is_deleted');
        return $items;
    }

    /**
     * 日別でレコードを取得
     * グループ別：全タイプ
     */
    public static function getDateItemGroupAllType($serch, $group_id, $date)
    {
        $items = DB::table($serch)
            ->select(self::$select)
            ->where('g.id', $group_id)
            ->where('date', $date)
            ->whereNull('is_deleted');
        return $items;
    }

    /**
     * 日別でレコードを取得
     * 個人：タイプ別
     */
    public static function getDateItemPersonByType($serch, $item_type, $date, $uid)
    {
        $items = DB::table($serch)
            ->select(self::$select)
            ->where('item_type', $item_type)
            ->where('date', $date)
            ->where('uid', $uid)
            ->whereNull('is_deleted');
        return $items;
    }

    /**
     * 日別でレコードを取得
     * 個人：全タイプ
     */
    public static function getDateItemPersonAllType($serch, $date,$uid)
    {
        $items = DB::table($serch)
            ->select(self::$select)
            ->where('date', $date)
            ->where('uid', $uid)
            ->whereNull('is_deleted');
        return  $items;
    }
}
