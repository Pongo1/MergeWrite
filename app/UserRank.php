<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
    //
        protected $fillable=['rank','rank_worth','rank_description','rank_cost','number'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
