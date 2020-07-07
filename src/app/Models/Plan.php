<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    protected $table = 'plans';
    protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
    ];


    /** バリデーションルール */
    public static $rules = [
        'plan_title' => 'required|max:50',
        'start' => 'required|date',
        'finish' => 'required|date',
        // 'map_item' => "required|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s",
        'map_item' => "nullable|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s",
        'comment' => 'max:1000',
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'plan_title.required' => 'タイトルを入力してください。',
        'plan_title.max' => '50文字以内で入力してください。',
        'start.required' => '日付を入力してください。',
        'start.date' => '正しい日付を入力してください。',
        'finish.required' => '日付を入力してください。',
        'finish.date' => '正しい日付を入力してください。',
        // 'map_item.required' => 'リンクを入力してください。',
        'map_item.regex' => '正しいリンクを入力してください。',
        'comment.max' => '1000文字以内で入力してください。',
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


    /**
     * 削除済のソートname
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortNameAsc()
    {
        $plan = $this->onlyTrashed()->orderBy('plan_title', 'asc')->paginate($this->p_num);
        return $plan;
    }

    /**
     * 削除済のソートname
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortNameDesc()
    {
        $plan = $this->onlyTrashed()->orderBy('plan_title', 'desc')->paginate($this->p_num);
        return $plan;
    }

    /**
     * 削除済のソートdate
     * asc
     *
     * @return void
     */
    public function scopeTrashedSortStartAsc()
    {
        $plan = $this->onlyTrashed()->orderBy('start', 'asc')->paginate($this->p_num);
        return $plan;
    }

    /**
     * 削除済のソートdate
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortStartDesc()
    {
        $plan = $this->onlyTrashed()->orderBy('start', 'desc')->paginate($this->p_num);
        return $plan;
    }
}
