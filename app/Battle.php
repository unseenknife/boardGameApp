<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    //admin login
    //email = admin@admin.com
    //ww = Welkom01

    protected $guarded = [];

    //relation with the model Game, battle belongs to Game, foreign key in table Battle = game_id
    public function Game()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    //relation with the model Battle_player, battle has many Battle_player
    public function Battle_player()
    {
        return $this->hasMany('App\Battle_player');
    }

    //relation with the model Player, battle belongs to Player, foreign key in table Battle = wonBy
    public function Player()
    {
        return $this->belongsTo('App\Player', 'wonBy');
    }

    //function that gives true or false, this is used in the nav
    //function looks if the user in lobby is or not, if user is in lobby return false, if user is in lobby return true
    //this function ensures that you only can see the Lobby tab in nav, when you are in a lobby
    public static function inLobby($userId){
        if(Battle::whereNull('wonBy')
            ->join('battle_players', 'battle_players.battle_id', 'battles.id')
            ->where('battle_players.player_id', $userId)
            ->count() == 0){
            return false;
        }
        else{
            return true;
        }
    }
}