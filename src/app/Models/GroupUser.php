<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GroupUser extends Model
{
    protected $table = 'group_user';
    // protected $guarded = array('id');
    // use SoftDeletes;
}
