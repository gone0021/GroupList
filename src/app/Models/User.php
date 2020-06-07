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
        'id' => 'integer'
    ];

    public function group()
    {
        // return $this->belongsToMany('App\Models\Groups', 'groups_users','user_id', 'group_id' );
        return $this->belongsToMany('App\Models\Group');
    }

    public function groupUser()
    {
        // return $this->hasMany('App\Models\GroupUser', 'id', 'user_id' );
        return $this->belongsTo('App\Models\GroupUser', 'user_id', 'id');
    }

    // public function scopeSoftDelete($query, $str)
    // {
    //     return  $this->onlyTrashed()->where('airline_id', 1);
    // }

    public $p_num = 7;
    public function scopeSortId()
    {
        $group = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeSortName()
    {
        $group = $this->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeTrashedSortId()
    {
        $group = $this->onlyTrashed()->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeTrashedSortName()
    {
        $group = $this->onlyTrashed()->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $group;
    }
}
