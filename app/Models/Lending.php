<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lending extends Model
{
    use SoftDeletes;

    //protected $dates = ['deleted_at'];

    public function books()
    {
    	return $this->belongsToMany('App\Models\Book')->withTrashed();
    }

    

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
