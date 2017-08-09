<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable =['chapter_title'];
    public function book(){
      return $this->belongsTo('App\Book');
    }

    public function pages(){
      return $this->hasMany('App\Page');
    }
}
