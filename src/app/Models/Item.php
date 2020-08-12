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
}
