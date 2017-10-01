<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Note;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_picture','is_mentor','new'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function invites(){
        return $this->hasMany('App\Invite');
    }
    public function rank(){
        return $this->hasOne('App\UserRank');
    }
    public function publishes(){
        return $this->hasMany('App\Publish');
    }
    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function books(){
      return $this->hasMany('App\Book');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function bank(){
        return $this->hasOne('App\UserBank');
    }
    public function grabs(){
        return $this->belongsToMany('App\Publish');
    }
}
