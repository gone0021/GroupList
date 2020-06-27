<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';
    protected $primaryKey = [ 'group_id', 'user_id', 'group_admin' ];
    public $incrementing = false;

    public function user()
    {
        return $this->hasMany('App\Models\User', 'user_id', 'id' );
    }

    public function group()
    {
        return $this->hasMany('App\Models\Group', 'group_id', 'id'  );
    }

    public function scopeUserId($query, $n)
    {
        return $query->where('user_id', $n);
    }

    public function scopeGroupId($query, $n)
    {
        return $query->where('group_id', $n);
    }
}
