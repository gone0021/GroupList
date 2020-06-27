<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        // 'id' => 'integer',
        // 'id_admin' => 'integer'
    ];

    public function group()
    {
        return $this->belongsToMany('App\Models\Group');
    }

    public function groupUser()
    {
        return $this->belongsTo('App\Models\GroupUser', 'user_id', 'id');
    }

    public function trip()
    {
        return $this->hasMany('App\Models\Trip');
    }



    /************
    - sort -
    ************/
    public $p_num = 7;
    public function scopeSortIdAsc()
    {
        $user = $this->orderBy('id', 'asc')->paginate($this->p_num);
        return $user;
    }
    public function scopeSortIdDesc()
    {
        $user = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $user;
    }

    public function scopeSortNameAsc()
    {
        $user = $this->orderBy('user_name', 'asc')->paginate($this->p_num);
        return $user;
    }
    public function scopeSortNameDesc()
    {
        $user = $this->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $user;
    }

    public function scopeTrashedSortIdAsc()
    {
        $user = $this->onlyTrashed()->orderBy('id', 'asc')->paginate($this->p_num);
        return $user;
    }
    public function scopeTrashedSortIdDesc()
    {
        $user = $this->onlyTrashed()->orderBy('id', 'desc')->paginate($this->p_num);
        return $user;
    }

    public function scopeTrashedSortNameAsc()
    {
        $user = $this->onlyTrashed()->orderBy('user_name', 'asc')->paginate($this->p_num);
        return $user;
    }
    public function scopeTrashedSortNameDesc()
    {
        $user = $this->onlyTrashed()->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $user;
    }
}
