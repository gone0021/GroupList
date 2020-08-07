<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public $p_num = 7;
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
        $sql =
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
        JOIN groups as g ON gu.group_id = g.id';

        return $sql;
    }

    /**
     * unon dive_logs以外のアイテム
     */
    public function scopeUnionNoDivelog()
    {
        $sql =
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        )
        JOIN users as u ON uid = u.id
        JOIN group_user as gu ON u.id = gu.user_id
        JOIN groups as g ON gu.group_id = g.id';

        return $sql;
    }

    /**
     * unon 全てのアイテム、かつグループとのjoinなし
     */
    public function scopeUnionAllNoGroup()
    {
        $sql =
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

        return $sql;
    }


    /**
     * unon dive_logs以外のアイテム
     */
    public function scopeUnionNoDivelognoGroup()
    {
        $sql =
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
        FROM plans as p
        )
        JOIN users as u ON uid = u.id

        ';

        return $sql;
    }

        /**
     * unon 全てのアイテム
     */

    // public function scopeUnionAllForCalendar()
    // {
    //     $sql =
    //         '(
    //     SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
    //     FROM trips as t
    //     UNION
    //     SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
    //     FROM plans as p
    //     UNION
    //     SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open, deleted_at as is_deleted
    //     FROM dive_logs as d
    //     )
    //     JOIN group_user as gu ON uid = gu.user_id
    //     JOIN users as u ON gu.user_id = u.id
    //     JOIN groups as g ON gu.group_id = g.id
    //     ';

    //     return $sql;
    // }

    // public function scopeUnionNoGroupForCalendar()
    // {
    //     $sql =
    //         '(
    //     SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
    //     FROM trips as t
    //     UNION
    //     SELECT id as item_id, item_type, title, date(start) as date, user_id as uid, status, open_range, is_open, deleted_at as is_deleted
    //     FROM plans as p
    //     UNION
    //     SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open, deleted_at as is_deleted
    //     FROM dive_logs as d
    //     )
    //     ';

    //     return $sql;
    // }


    public function scopeDateItemPersonAllType($query, $date)
    {
        return $query->select("item_id", "group_name", "item_type", "title", "date", "user_name", "status", "open_range", "is_open")
            ->where('date', $date);
    }

    public function scopeDateItemPersonByType($query, $item_type, $date)
    {
        return $query->select("item_id", "group_name", "item_type", "title", "date", "user_name", "status", "open_range", "is_open")
            ->where('item_type', $item_type)
            ->where('date', $date);
    }

    public function scopeDateItemGroupAllType($query, $group_id, $date)
    {
        return $query->select("item_id", "group_name", "item_type", "title", "date", "user_name", "status", "open_range", "is_open")
            ->where('g.id', $group_id)
            ->where('date', $date);
    }

    public function scopeDateItemGroupByType($query, $group_id, $item_type, $date)
    {
        return
        // $query
        DB::table($this->UnionAll())
        ->select("item_id", "group_name", "item_type", "title", "date", "user_name", "status", "open_range", "is_open")
            ->where('g.id', $group_id)
            ->where('item_type', $item_type)
            ->where('date', $date);
            // ->paginate($this->p_num);

    }
}
