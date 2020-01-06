<?php

namespace App\Http\Controllers;

use App\Battle;
use App\Game;
use App\Battle_player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GamesController extends Controller
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
            'games' => Game::all(),
            'user' => Auth::user()
        ];

        //return view games.index with variable data
        return view('games.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //if the auth user is the admin then return view games.create
        if(Auth::user()->role_id == 1) {
            return view('games.create');
        }
        //else redirect to games.index
        else{
            return redirect(route('games.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make name, minPlayer, maxPlayer, duration, description and file required
        request()->validate([
            'name' => 'required',
            'minPlayer' => 'required',
            'maxPlayer' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        //make new game
        $game = new Game();
        $game->name = $request->name;
        $game->minPlayer = $request->minPlayer;
        $game->maxPlayer = $request->maxPlayer;
        $game->duration = $request->duration;
        $game->description = $request->description;
        //save game
        $game->save();

        //set variable path store request->file in public and save it as the title name (variable given in  form) .jpg
        $path = $request->file('file')->storeAs(
            'public', 'gameId'. $game->id . '.jpg'
        );

        //return redirect games.index with message
        return redirect(route('games.index'))->with('success', 'Game with success added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //set variable countIsPlayerInLobby it looks if the (auth)user is in lobby
        $countIsPlayerInLobby = Battle::whereNull('wonBy')
            ->join('battle_players', 'battle_players.battle_id', 'battles.id')
            ->where('battle_players.player_id', Auth::id())
            ->count();

        //set variable user with Auth user
        $user = Auth::user();

        //set variable data with variables
        $data = [
            'game' => $game,
            'countIsPlayerInLobby' => $countIsPlayerInLobby,
            'user' => $user
        ];

        //return view games.show with variable data
        return view('games.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(game $game)
    {
        //if the auth user admin is then return view games.edit with variable game
        if(Auth::user()->role_id == 1) {
            return view('games.edit', compact('game'));
        }
        //else redirect to games.index
        else{
            return redirect(route('games.index)'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, game $game)
    {
        //make name, minPlayer, maxPlayer, duration, description and file required
        request()->validate([
            'name' => 'required',
            'minPlayer' => 'required',
            'maxPlayer' => 'required',
            'duration' => 'required',
            'description' => 'required',
        ]);

        //if there is a file
        //set variable path store request->file in public and save it as the title name (variable given in  form) .jpg
        if($request->file){
            $path = $request->file('file')->storeAs(
                'public', 'gameId'. $game->id . '.jpg'
            );
        }

        //update game
        $game->name = $request->name;
        $game->minPlayer = $request->minPlayer;
        $game->maxPlayer = $request->maxPlayer;
        $game->duration = $request->duration;
        $game->description = $request->description;
        //save game
        $game->save();

        //return redirect to games.index with message
        return redirect(route('games.index'))->with('success', 'Game changed with success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //delete game
        $game->delete();

        //return redirect to games.index with message
        return redirect(route('games.index'))->with('Success', 'Game deleted');
    }
}
