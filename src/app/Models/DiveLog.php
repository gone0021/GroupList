<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Divelog extends Model
{
    protected $table = 'dive_logs';
    protected $guarded = array('id');
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
    ];

    /** バリデーションルール */
    public static $rules = [
        'title' => 'required|max:100',
        'date' => 'required|date',
        'dive_num' => 'required|integer',
        'point' => 'nullable|max:100',
        'shop' => 'nullable|max:100',
        'start_time' => 'nullable|date_format:H:i',
        'finish_time' => 'nullable|date_format:H:i|after:start_time',
        'start_air' => 'nullable|integer',
        'finish_air' => 'nullable|integer',
        'avg_depth' => 'nullable|numeric ',
        'max_depth' => 'nullable|numeric ',
        'water_temp' => 'nullable|integer ',
        'temp' => 'nullable|integer',
        'view' => 'nullable|integer',
        'suit_size' => 'nullable|numeric',
        'weight' => 'nullable|integer',
        'map' => "nullable|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s",
        'comment' => 'nullable|max:1000',
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'title.required' => 'タイトルを入力してください。',
        'title.max' => '50文字以内で入力してください。',
        'date.required' => '日付を入力してください。',
        'date.date' => '正しい日付を入力してください。',
        'dive_num.required' => 'ダイブNo.を入力してください。',
        'dive_num.integer' => '整数で入力してください。',
        'point.max' => '100文字以内で入力してください。',
        'shop.max' => '100文字以内で入力してください。',
        'start_time.date_format' => '正しい時間を入力してください。',
        'finish_time.date_format' => '正しい時間を入力してください。',
        'finish_time.after' => '開始時間より後の時間を入力してください。',
        'avg_depth.numeric' => '数字を入力してください。',
        'max_depth.numeric' => '数字を入力してください。',
        'water_temp.integer' => '整数を入力してください。',
        'temp.integer' => '整数を入力してください。',
        'view.integer' => '整数を入力してください。',
        'weight.integer' => '整数を入力してください。',
        'suit_size.numeric' => '数字を入力してください。',
        'map.regex' => '正しいリンクを入力してください。',
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
        $trip = $this->onlyTrashed()->orderBy('title', 'asc');
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
        $trip = $this->onlyTrashed()->orderBy('title', 'desc');
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
        $trip = $this->onlyTrashed()->orderBy('date', 'asc');
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
        $trip = $this->onlyTrashed()->orderBy('date', 'desc');
        return $trip;
    }
}
