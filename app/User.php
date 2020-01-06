<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //admin login
    //email = admin@admin.com
    //ww = Welkom01

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //relation with the model Player, one User has one Player, foreign key = id
    public function Player()
    {
        return $this->hasOne('App\Player', 'id');
    }

    //relation with the model Battle_player, User has many battle_player, foreign key = player_id
    public function Battle_player()
    {
        return $this->hasMany('App\Battle_player', 'player_id');
    }

}
