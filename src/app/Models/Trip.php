<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    protected $table = 'trips';
    protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
    ];


    /** バリデーションルール */
    public static $rules = [
        'trip_title' => 'required|max:50',
        'start' => 'required|date',
        'finish' => 'required|date',
        'point_name' => 'required|max:50',
        'map_item' => "required|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s",
        'comment' => 'max:1000',
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'trip_title.required' => 'タイトルを入力してください。',
        'trip_title.max' => '50文字以内で入力してください。',
        'date.required' => '日付を入力してください。',
        'date.date' => '正しい日付を入力してください。',
        'trip_title.max' => '50文字以内で入力してください。',
        'start.required' => '日付を入力してください。',
        'finish.date' => '正しい日付を入力してください。',
        'point_name.required' => 'タイトルを入力してください。',
        'point_name.max' => '50文字以内で入力してください。',
        'map_item.required' => 'リンクを入力してください。',
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
        $trip = $this->onlyTrashed()->orderBy('trip_title', 'asc')->paginate($this->p_num);
        return $trip;
    }

    /**
     * 削除済のソートname
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortNameDesc()
    {
        $trip = $this->onlyTrashed()->orderBy('trip_title', 'desc')->paginate($this->p_num);
        return $trip;
    }

    /**
     * 削除済のソートdate
     * asc
     *
     * @return void
     */
    public function scopeTrashedSortDateAsc()
    {
        $trip = $this->onlyTrashed()->orderBy('date', 'asc')->paginate($this->p_num);
        return $trip;
    }

    /**
     * 削除済のソートdate
     * desc
     *
     * @return void
     */
    public function scopeTrashedSortDateDesc()
    {
        $trip = $this->onlyTrashed()->orderBy('date', 'desc')->paginate($this->p_num);
        return $trip;
    }
}
