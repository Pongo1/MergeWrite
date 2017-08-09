<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['Title'];
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function chapters(){
      return $this->hasMany('App\Chapter');
    }

}
