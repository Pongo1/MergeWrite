<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{

    protected $fillable=['coins'];


    public function user(){
        return $this->belongsTo('App\User');
    }
}
