<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;

    /** usersのリレーション
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /** 中間テーブルのリレーション
     *
     * @return void
     */
    public function groupUser()
    {
        return $this->belongsTo('App\Models\GroupUser', 'group_id', 'id');
    }

    // ------ sort ------

    /**
     * ソートid
     * asc
     *
     * @return void
     */
    public function scopeSortIdAsc()
    {
        $group = $this->orderBy('id', 'asc')->paginate($this->p_num);
        return $group;
    }

    /**
     * ソートid
     * desc
     *
     * @return void
     */
    public function scopeSortIdDesc()
    {
        $group = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    /**
     * ソートname
     * asc
     *
     * @return void
     */
    public function scopeSortNameAsc()
    {
        $group = $this->orderBy('group_name', 'asc')->paginate($this->p_num);
        return $group;
    }

    /**
     * ソートname
     * desc
     *
     * @return void
     */
    public function scopeSortNameDesc()
    {
        $group = $this->orderBy('group_name', 'desc')->paginate($this->p_num);
        return $group;
    }

    /**
     * 削除済のソートid
     * asc
     *
     * @return void
     */
    public function scopeTrashedSortIdAsc()
    {
        $group = $this->onlyTrashed()->orderBy('id', 'asc')->paginate($this->p_num);
        return $group;
    }

    /**
     * 削除済のソートid
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortIdDesc()
    {
        $group = $this->onlyTrashed()->orderBy('id', 'desc')->paginate($this->p_num);
        return $group;
    }

    /**
     * 削除済のソートname
     * asc
     *
     * @return void
     */
    public function scopeTrashedSortNameAsc()
    {
        $group = $this->onlyTrashed()->orderBy('group_name', 'asc')->paginate($this->p_num);
        return $group;
    }

    /**
     * 削除済のソートname
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortNameDesc()
    {
        $group = $this->onlyTrashed()->orderBy('group_name', 'desc')->paginate($this->p_num);
        return $group;
    }
}
