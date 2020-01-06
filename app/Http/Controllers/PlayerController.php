<?php

namespace App\Http\Controllers;

use App\Battle_player;
use App\Battle;
use App\Game;
use App\Player;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //set variable data with variables
        $data = [
            'players' => Player::all(),
        ];

        //return view players.index with variable data
        return view('players.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //set variable gamesPlayed, it counts how manny battles you have played
        $gamesPlayed = Battle_player::where('player_id', $player->id)
            ->join('battles', 'battles.id', 'battle_players.battle_id')
            ->whereNotNull('battles.wonBy')
            ->count();

        //set variable gamesWon, it counts how many games you have won
        $gamesWon = Battle::where('wonBy', $player->id)
            ->count();

        //set variable games with all games
        $games= Game::all();

        //make an array $statics and set variable i
        $statics[] = [];
        $i=0;

        //foreach game ...
        foreach($games as $game) {

            //fill ['gamesPlayed'] with a count of how manny battles you have played from a specific game
            $statics[$i]['gamePlayed'] = Battle_player::where('player_id', $player->id)
                ->join('battles', 'battles.id', 'battle_players.battle_id')
                ->whereNotNull('battles.wonBy')
                ->where('battles.game_id', $game->id)
                ->count();
            //fill ['gameWon'] with a count of how manny battles you have won from a specific game
            $statics[$i]['gameWon'] = Battle_player::where('player_id', $player->id)
                ->join('battles', 'battles.id', 'battle_players.battle_id')
                ->where('battles.wonBy', $player->id)
                ->where('battles.game_id', $game->id)
                ->count();
            //fill ['gameId'] with the game id
            $statics[$i]['gameId'] = $game->id;
            //fill ['gameName'] with the game name
            $statics[$i]['gameName'] = $game->name;
            //fill ['battlesPlayed'] with the battles that a player has played from a specific game
            $statics[$i]['battlesPlayed'] = Battle_player::where('player_id', $player->id)
                ->join('battles', 'battles.id', 'battle_players.battle_id')
                ->join('players', 'players.id', 'battles.wonBy')
                ->whereNotNull('battles.wonBy')
                ->where('game_id', $game->id)
                ->get();
            //every loop do i++ set variable i +1
            $i++;

        }

        //set variable data with variables
        $data = [
            'statics' => $statics,
            'player' => $player,
            'gamesPlayed' => $gamesPlayed,
            'games' => $games,
            'gamesWon' => $gamesWon
        ];

        //return view players.show with variable data
        return view('players.show')->with($data);
    }

    //make function to set status to online when logged in
    public function statusOnline(){

        //set variable player from auth
        $player = Player::find(Auth::id());

        //update player the gamestatus to online
        $player->gameStatus = 'online';
        //save player
        $player->save();

        //return redirect to games.index
        return redirect(route('games.index'));
    }

    //make function to set status to offline when logged out
    public function statusOffline(){

        //set variable player from auth
        $player = Player::find(Auth::id());

        //update player the gamestatus to offline
        $player->gameStatus = 'offline';
        //save player
        $player->save();

        //logout logged in user
        Auth::logout();

        //return redirect to login
        return redirect(route('login') );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //if player id is the same as the auth user then return view players.edit with variable player
        if($player->id == Auth::id()) {
            return view('players.edit', compact('player'));
        }
        //else return redirect auth user own edit
        else{
            return redirect(route('players.edit', Auth::id()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //make nickname, cursor and gameStatus required
        $this->validate($request, [
            'nickname' => 'required',
            'cursor' => 'required',
            'gameStatus' => 'required'
        ]);

        //if there is a file
        //set variable path store request->file in public and save it as the title name (variable given in  form) .jpg
        if($request->file){
            $path = $request->file('file')->storeAs(
                'public', 'playerId'. $player->id . '.jpg'
            );
        }

        //update player
        $player->nickname = $request->nickname;
        $player->gameStatus = $request->gameStatus;
        $player->cursor = $request->cursor;
        //save player
        $player->save();

        //return redirect to players.edit from the auth user with message
        return redirect(route('players.edit', Auth::id()))->with('success', 'Player updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
}
