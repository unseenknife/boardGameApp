<?php

namespace App\Http\Controllers;

use App\Battle;
use App\Battle_player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Battle_playerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //variable playerLobby looks in which lobby the player is
        $playerLobby = Battle::whereNull('wonBy')
            ->join('battle_players', 'battle_players.battle_id', 'battles.id')
            ->where('battle_players.player_id', Auth::id())
            ->get();

        //return redirect route battles.show with variable battle_id from not finished battle (lobby)
        return redirect(route('battles.show',$playerLobby->first()->battle_id));

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
        //create new battle_player
        //this is when a player wants to join an existing lobby
        $battle_player = new Battle_player();
        $battle_player->battle_id = $request->battle_id;
        $battle_player->player_id = Auth::id();
        //save battle_player
        $battle_player->save();

        //return redirect to battles.show from the lobby it just joined
        return redirect(route('battles.show', $battle_player->battle_id))->with('success', 'Battle joined');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
