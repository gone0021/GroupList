<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Rules\Current;

class User extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;

    /**
     * groupsのリレーション
     *
     * @return void
     */
    public function group()
    {
        return $this->belongsToMany('App\Models\Group');
    }

    /**
     * tripsとのリレーション
     *
     * @return void
     */
    public function trip()
    {
        return $this->hasMany('App\Models\Trip');
    }

    /**
     *  dive_logsとのリレーション
     *
     * @return void
     */
    public function diveLog()
    {
        return $this->hasMany('App\Models\DiveLog');
    }

    /**
     * plansとのリレーション
     *
     * @return void
     */
    public function plan()
    {
        return $this->hasMany('App\Models\Plna');
    }

    /** バリデーションルール */
    public static $rules = [
        'email' => ['string','email','max:255'],
        'birthday' => ['date'],
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'email.email' => 'メールアドレスを入力してください',
        'email.max' => '255文字まで',
        'birthday.date' => '日付を入力してください',
    ];

    // ------ sort ------

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
