<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');
    use SoftDeletes;


    protected $casts = [
        'id' => 'integer'
    ];

    public function group()
    {
        // return $this->belongsToMany('App\Models\Groups', 'groups_users','user_id', 'group_id' );
        return $this->belongsToMany('App\Models\Group');
    }

}
