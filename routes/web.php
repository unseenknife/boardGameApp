<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin login
//email = admin@admin.com
//ww = Welkom01


Route::get('/', function () {
    return redirect()->route('games.index');
});

/** method aanroepen in de gamesController */

Route::resource('games', 'GamesController')
    ->middleware('auth');

Route::resource('players', 'PlayerController')
    ->middleware('auth');

Route::resource('battles', 'BattleController')
    ->except('create')
    ->middleware('auth');

Route::get('battles/create/{gameId}', 'BattleController@create')->name('battles.create');

Route::resource('battle_players', 'Battle_playerController')
    ->middleware('auth');

Route::get('statusOnline', 'PlayerController@statusOnline')->name('players.statusOnline');

Route::post('statusOffline', 'PlayerController@statusOffline')->name('players.statusOffline');


Route::resource('users', 'UserController')
    ->middleware('auth');

Auth::routes();
