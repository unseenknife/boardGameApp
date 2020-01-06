@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-2">
                                <!--haalt hieronder de gamename op, maar haalt elke spatie weg hieruit en zoekt naar een bestand met deze naam in public/images-->
                                <img class="card-img-top" src="{{asset('storage')}}/playerId{{$player->id}}.jpg">
                            </div>
                            <div class="col-md-10">
                                <div class="card-block">
                                    {{--<div class="row">--}}
                                        <h4 class="card-title">{{$player->nickname}}</h4>
{{--                                        <h6 class="card-subtitle mb-2 player_{{$player->gameStatus}} playerStatus"><i class="fas fa-circle playerShowStatus"></i> {{$player->gameStatus}}</h6>--}}
                                    {{--</div>--}}
                                    <h6 class="card-subtitle mb-2">Total games won: {{$gamesWon}}</h6>
                                    <h6 class="card-subtitle mb-2">Total games played: {{$gamesPlayed}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($statics as $static)
                        <div class="col-md-10 lobbyCard">
                            <a data-toggle="collapse" href="#game{{$static['gameId']}}" aria-expanded="true" aria-controls="collapseOne" class="list-group-item list-group-item-action flex-column align-items-start" >
                                <div class="row">
                                    <h6 class="card-title col-md-4 cardLobbyList">{{$static['gameName']}}</h6>
                                    <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">Games won:{{$static['gameWon']}}</h6>
                                    <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">Games played: {{$static['gamePlayed']}}</h6>
                                </div>
                            </a>
                        </div>
                        <div id="game{{$static['gameId']}}" class="col-md-10 lobbyCard collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-body col-md-10">
                                <div class="card-body">
                                    @foreach($static['battlesPlayed'] as $battlePlayed)
                                        <div class="row showBattleProfile">
                                            <a class="btn btn-primary widthBtn" href="{{route('battles.show', $battlePlayed->battle_id)}}">
                                                <h6 class="btnProfileBattle">
                                                    Battle: {{$battlePlayed->battleName}}
                                                </h6>
                                                <h6 class="btnProfileBattle">
                                                    Winner: {{$battlePlayed->nickname}}
                                                </h6>
                                                <h6 class="btnProfileBattle">
                                                    {{date('d-m-Y  H:m', strtotime($battlePlayed->updated_at))}}
                                                </h6>
                                           </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endsection