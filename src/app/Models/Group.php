<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    protected $table = 'groups';
    protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function groupUser()
    {
        // return $this->hasMany('App\Models\GroupUser', 'id', 'group_id' );
        return $this->belongsTo('App\Models\GroupUser', 'group_id', 'id' );
    }

    public $p_num = 7;
    public function scopeSortId()
    {
        $group = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeSortName()
    {
        $group = $this->orderBy('group_name', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeTrashedSortId()
    {
        $group = $this->onlyTrashed()->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    public function scopeTrashedSortName()
    {
        $group = $this->onlyTrashed()->orderBy('group_name', 'desc')->paginate($this->p_num);
        return $group;
    }
}
