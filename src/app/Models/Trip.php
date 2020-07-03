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
        'date' => 'required|date',
        'point_name' => 'required|max:50',
        'map_item' => "required|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s",
        'comment' => 'max:1000',
    ];

    /** カスタマイズしたバリデーションエラーメッセージ */
    public static $messages = [
        'trip_title.required' => 'タイトルを入力してください。',
        'trip_title.max' => '50文字以内で入力してください。',
        'date.required' => '日付を入力してください。',
        'date.date' => '正しい日付を入力してください。',
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

    /** バリデーションルール */


    /** バリデーションメッセージ */
}
