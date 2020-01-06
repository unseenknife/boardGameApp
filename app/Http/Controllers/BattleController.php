<?php

namespace App\Http\Controllers;

use App\Battle;
use App\Battle_player;
use App\Game;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //set variable hasPlayerPlayed, it counts how manny battles you have played
        $hasPlayerPlayed = Battle_player::where('player_id', Auth::id())
            ->join('battles', 'battles.id', 'battle_players.battle_id')
            ->whereNotNull('battles.wonBy')
            ->count();

        //if player has played a battle then do below
        if ($hasPlayerPlayed != 0) {

            //set variable user with the Auth user
            $user = Auth::user();

            //set variable battle_players are the battles the player has played
            $battle_players = Battle_player::where('player_id', Auth::id())
                ->get();

            //set variable data with variables
            $data = [
                'user' => $user,
                'battle_players' => $battle_players,
            ];

            //return view battles.index with variable data
            return view('battles.index')->with($data);
        }
        //if player has not played a battle then return route games.index
        else{
            return redirect(route('games.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gameId)
    {
        //set variable game, get the specific game from the table games
        $game = Game::where('id', $gameId)
            ->get();

        //set variable data with variables
        $data = [
          'game' => $game,
        ];
        //return view battles.create with variable data
        return view('battles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make battleName and game_id required
        request()->validate([
            'battleName' => 'required',
            'game_id' => 'required'
            ]);

        //make new Battle
        $battle = new Battle();
        //set time now
        $battle->dtPlayed = Carbon::now();
        $battle->battleName = $request->battleName;
        $battle->game_id = $request->game_id;
        //save battle
        $battle->save();

        //make new Battle_player
        $battle_player = new Battle_player();
        $battle_player->battle_id = $battle->id;
        $battle_player->player_id = Auth::id();
        //save Battle_player
        $battle_player->save();

        //return redirect battles.show from saved battle with message
        return redirect(route('battles.show', $battle->id))->with('success', 'Battle with succes added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Battle $battle)
    {
        //set variable battle_players with the players that played the battle
        $battle_players = Battle_player::where('battle_id', $battle->id)
            ->get();

        //set variable first_player with the player that made the battle
        $first_player = Battle_player::where('battle_id', $battle->id)
            ->first();

        //set variable user with the auth user
        $user = Auth::user();

        //set variable data with variables
        $data = [
            'battle_players' => $battle_players,
            'battle' => $battle,
            'user' => $user,
            'first_player' => $first_player
        ];

        //return view battles.create with variable data
        return view('battles.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function edit(Battle $battle)
    {
        //set variable battlePlayed where battle is not played from a specific battle and count it
        $battlePlayed = Battle::whereNull('wonBy')
            ->where('id', $battle->id)
            ->count();

        //set variable lobbyMaker, with the creator from the battle
        $lobbyMaker = Battle_player::where('battle_id', $battle->id)
            ->orderBy('created_at')
            ->first();

        //if the battle is yet not played and the (auth)user is the lobby owner then do below
        if($battlePlayed == 1 && $lobbyMaker->player_id == Auth::id()) {

            //set variable data with variables
            $data = [
                'user' => Auth::user(),
                'battle' => $battle,
            ];

            //return view battles.edit with data
            return view('battles.edit')->with($data);
        }
        //if the battle is already played or it is not the lobbyOwner then redirect to the show of that battle
        else{
            return redirect(route('battles.show', $battle->id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Battle $battle)
    {
        //make wonBy required
        $this->validate($request, [
            'wonBy' => 'required',
        ]);

        //update from battle wonBy by wonBy from request
        $battle->wonBy = $request->wonBy;
        //save battle
        $battle->save();

        //return redirect to battles.index with message
        return redirect(route('battles.index'))->with('success', 'Battle has been played');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Battle $battle)
    {
        //delete battle
        $battle->delete();

        //return redirect to battles.index with message
        return redirect(route('battles.index'))->with('success', 'Battle has been deleted');

    }
}
