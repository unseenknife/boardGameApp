<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //admin login
    //email = admin@admin.com
    //ww = Welkom01

    protected $guarded = [];

    //relation with the model User, one Player has one User, foreign key = id
    public function User()
    {
        return $this->hasOne('App\User', 'id');
    }

    //relation with the model Battle, Player has many Battle
    public function Battle()
    {
        return $this->hasMany('App\Battle');
    }

    //function that gives 1 or 2, this is used in the head
    //function looks if the player has cursor 1 or 2
    //this function set the cursor settings
    public static function cursor($userId)
    {
        $cursor = Player::where('id', 1)
            ->first()
            ->cursor;

        if($cursor == 1) {
            return 1;
        }
        else{
            return 2;
        }
    }
}
