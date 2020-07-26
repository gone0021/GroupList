<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    // protected $table = 'trips';
    // protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
    ];

    public function user()
    {
        // return $this->hasMany('App\Models\GroupUser', 'id', 'user_id' );
        return $this->belongsTo('App\Models\User');
    }

    public function groupUser()
    {
        return $this->belongsTo('App\Models\GroupUser', 'user_id', 'user_id');
    }

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
        $rawQuery =
            '(SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, start, user_id as uid, status, open_range, is_open
        FROM plans as p
        UNION
        SELECT id as item_id, item_type, title, date, user_id as uid, 99, open_range, is_open
        FROM dive_logs as d
        )
        JOIN group_user as gu ON uid = gu.user_id
        JOIN users as u ON gu.user_id = u.id
        JOIN groups as g ON gu.group_id = g.id';

        return $rawQuery;
    }

    public function scopeUnionNoDivelog()
    {
        $rawQuery =
            '(SELECT id as item_id, item_type, title, date, user_id as uid, status, open_range, is_open
        FROM trips as t
        UNION
        SELECT id as item_id, item_type, title, start, user_id as uid, status, open_range, is_open
        FROM plans as p
        )
        JOIN group_user as gu ON uid = gu.user_id
        JOIN users as u ON gu.user_id = u.id
        JOIN groups as g ON gu.group_id = g.id';

        return $rawQuery;
    }
}
