<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'description', 'image'];

    public function authors()
    {
    	//return $this->belongsToMany('App\Models\Author');
        //dd(Author::class);
        return $this->belongsToMany(Author::class);
    }

    public function lendings()
    {
    	return $this->belongsToMany('App\Models\Lending');
    }

    public function newBook($request, $nameFile = '')
    {
        $data = $request->all();
        $data['image'] = $nameFile;
        $book = $this->create($data);
        $book->authors()->attach($request->input('authors'));
        return $book;
    }
}
