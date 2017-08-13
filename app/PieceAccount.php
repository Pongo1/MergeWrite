<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PieceAccount extends Model
{

    protected $table ='pieceaccounts';
    protected $fillable =['coins'];


    public function piece(){
        return $this->belongsTo('App\Publish');
    }
}
