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
