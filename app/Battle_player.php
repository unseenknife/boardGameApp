<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battle_player extends Model
{
    //admin login
    //email = admin@admin.com
    //ww = Welkom01

    protected $guarded = [];

    //relation with the model Battle, battle_player belongs to Battle, foreign key in table Battle_player = battle_id
    public function Battle()
    {
        return $this->belongsTo('App\Battle', 'battle_id');
    }

    //relation with the model User, battle_player has many User, foreign key in table Battle_player = player_id
    public function User()
    {
        return $this->hasMany('App\User', 'id', 'player_id');
    }

    //function that gives true or false, this is used in the nav
    //function looks if the user already has played a battle, if user did not play a battle return false, if user had played in a battle return true
    //this function ensures that you only can see the Battles tab in nav, when you have played min. 1 Battle
    public static function didIPlay($userId)
    {
        if (Battle::whereNotNull('wonBy')
                ->join('battle_players', 'battle_players.battle_id', 'battles.id')
                ->where('battle_players.player_id', $userId)
                ->count() != 0) {
            return true;
        } else {
            return false;
        }
    }
}