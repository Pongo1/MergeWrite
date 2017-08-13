<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function publish(){
        return $this->belongsTo('App\Publish');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
