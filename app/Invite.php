<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    protected $fillable =['done'];

    public function note(){
        return $this->belongsTo('App\Note');
    }
    public function mentor(){
        return $this->belongsTo('App\User');
    }
}
