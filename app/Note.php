<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable =['title','note','skeleton_form','published','mother_values','mother_names','mentor_remark','marked','mark_coins'];


    public function invite(){
        return $this->hasOne('App\Invite');
    }
    public function publish(){
        return $this->hasOne('App\Publish');
    }



}
