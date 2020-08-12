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
        'title' => 'required|max:50',
        'start' => 'required|date',
        'finish' => 'required|date',
        'map' => 'nullable|regex:/<iframe src=\"https:\/\/www\.google\.com\/map(.*?)<\/iframe>/s',
        'comment' => 'nullable|max:1000',
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'title.required' => 'タイトルを入力してください。',
        'title.max' => '50文字以内で入力してください。',
        'start.required' => '日付を入力してください。',
        'start.date' => '正しい日付を入力してください。',
        'finish.required' => '日付を入力してください。',
        'finish.date' => '正しい日付を入力してください。',
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
}
