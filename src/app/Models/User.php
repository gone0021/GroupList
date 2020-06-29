<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    /** テーブル */
    protected $table = 'users';
    /** ガードするフィールド */
    protected $guarded = array('id');
    /** ソフトデリート */
    use SoftDeletes;

    protected $casts = [
        // 'id' => 'integer',
        // 'id_admin' => 'integer'
    ];

    /** groupsのリレーション
     * 
     * @return void
     */
    public function group()
    {
        return $this->belongsToMany('App\Models\Group');
    }

    /** 中間テーブルのリレーション
     * 
     * @return void
     */
    public function groupUser()
    {
        return $this->belongsTo('App\Models\GroupUser', 'user_id', 'id');
    }

    /** tripsのリレーション
     * 
     * @return void
     */
    public function trip()
    {
        return $this->hasMany('App\Models\Trip');
    }



    /************
    - sort -
    ************/

    /** ぺジネーションの数 */
    public $p_num = 7;

    /**
     * ソートid
     * asc
     * 
     * @return void
     */
    public function scopeSortIdAsc()
    {
        $user = $this->orderBy('id', 'asc')->paginate($this->p_num);
        return $user;
    }

    /**
     * ソートid
     * desc
     * 
     * @return void
     */
     public function scopeSortIdDesc()
    {
        $user = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $user;
    }

    /**
     * ソートname
     * asc
     * 
     * @return void
     */
    public function scopeSortNameAsc()
    {
        $user = $this->orderBy('user_name', 'asc')->paginate($this->p_num);
        return $user;
    }

    /**
     * ソートname
     * desc
     * 
     * @return void
     */
    public function scopeSortNameDesc()
    {
        $user = $this->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $user;
    }

    /**
     * 削除済のソートid
     * asc
     * 
     * @return void
     */
    public function scopeTrashedSortIdAsc()
    {
        $user = $this->onlyTrashed()->orderBy('id', 'asc')->paginate($this->p_num);
        return $user;
    }

    /**
     * 削除済のソートid
     * desc
     * 
     * @return void
     */
    public function scopeTrashedSortIdDesc()
    {
        $user = $this->onlyTrashed()->orderBy('id', 'desc')->paginate($this->p_num);
        return $user;
    }


    /**
     * 削除済のソートname
     * desc
     * 
     * @return void
     */
        public function scopeTrashedSortNameAsc()
    {
        $user = $this->onlyTrashed()->orderBy('user_name', 'asc')->paginate($this->p_num);
        return $user;
    }

    /**
     * 削除済のソートname
     * desc
     * 
     * @return void
     */
    public function scopeTrashedSortNameDesc()
    {
        $user = $this->onlyTrashed()->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $user;
    }
}
