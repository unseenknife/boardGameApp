<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //admin login
    //email = admin@admin.com
    //ww = Welkom01

    protected $guarded = [];

    //relation with the model Battle, Game has many Battle
    public function Battle()
    {
        return $this->hasMany('App\Battle');
    }
}