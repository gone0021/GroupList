<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Trip;
use App\Models\DiveLog;
use App\Models\Plan;

class Calendar extends Model
{
    public function scopeGetItemType()
    {
        $sql =
            '(
        SELECT t.id as item_id, item_type,user_id as uid
        from trips as t
        UNION
        SELECT p.id as item_id, item_type, user_id as uid
        FROM plans as p
        UNION
        SELECT d.id as item_id, item_type, user_id as uid
        FROM dive_logs as d
        )
        JOIN users as u ON u.id = uid';

        return $sql;
    }


}
