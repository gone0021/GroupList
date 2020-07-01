<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
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

    public $p_num = 7;
    public function scopeSortIdAsc()
    {
        $sort = $this->orderBy('id', 'asc')->paginate($this->p_num);
        return $sort;
    }
    public function scopeSortIdDesc()
    {
        $sort = $this->orderBy('id', 'desc')->paginate($this->p_num);
        return $sort;
    }

    public function scopeSortTitleAsc()
    {
        $sort = $this->where('user_id', 1)->orderBy('trip_title', 'asc')->paginate($this->p_num);
        return $sort;
    }
    public function scopeSortTitleDesc()
    {
        $sort = $this->orderBy('trip_title', 'desc')->paginate($this->p_num);
        return $sort;
    }


    public function scopeSortDateAsc()
    {
        $sort = $this->orderBy('date', 'asc')->paginate($this->p_num);
        return $sort;
    }
    public function scopeSortDateDesc()
    {
        $sort = $this->orderBy('date', 'desc')->paginate($this->p_num);
        return $sort;
    }

    public function scopeSortUserAsc()
    {
            $sort = $this->orderBy('user_name', 'asc')->paginate($this->p_num);
        return $sort;
    }
    public function scopeSortUserDesc()
    {
            $sort = $this->orderBy('user_name', 'desc')->paginate($this->p_num);
        return $sort;
    }}
