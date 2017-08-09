<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = ['page_title','body'];
    
    public function chapter(){
      return $this->belongsTo('App\Chapter');
    }
}
