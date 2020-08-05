<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

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

    public function scopeUnionAll()
    {
        $sql =
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, start as date, user_id as uid, status, open_range, is_open
        FROM plans as p
        UNION
        SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open
        FROM dive_logs as d
        )
        JOIN group_user as gu ON uid = gu.user_id
        JOIN users as u ON gu.user_id = u.id
        JOIN groups as g ON gu.group_id = g.id';

        return $sql;
    }

    public function scopeUnionNoDivelog()
    {
        $sql =
            '(
        SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, start as date, user_id as uid, status, open_range, is_open
        FROM plans as p
        )
        JOIN group_user as gu ON uid = gu.user_id
        JOIN users as u ON gu.user_id = u.id
        JOIN groups as g ON gu.group_id = g.id';

        return $sql;
    }

    public function scopeUnionAllForCalendar()
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
        JOIN group_user as gu ON uid = gu.user_id
        JOIN users as u ON gu.user_id = u.id
        JOIN groups as g ON gu.group_id = g.id
        ';

        return $sql;
    }
    public function scopeUnionNoGroupForCalendar()
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
        ';

        return $sql;
    }

}
