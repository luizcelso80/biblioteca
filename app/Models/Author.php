<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Author extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];


    protected $fillable =['name','surname'];

    public function books()
    {
    	//return $this->belongsToMany('App\Models\Book');
    	return $this->belongsToMany('App\Models\Book');
    }
}
