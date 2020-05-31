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
}
