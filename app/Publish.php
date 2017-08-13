<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publish extends Model
{
    protected $table ='publishes';

    public function user(){
        $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function bank(){
        return $this->hasOne('App\PieceAccount');
    }

    public function parentPiece(){
        return $this->belongsTo('App\Note');
    }
}
