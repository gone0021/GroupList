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

}
