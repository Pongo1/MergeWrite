<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable =['title','note','skeleton_form','published','mother_values','mother_names'];

    public function publish(){
        return $this->hasOne('App\Publish','parent_piece');
    }


}
