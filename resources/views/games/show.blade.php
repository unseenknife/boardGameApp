@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-2">
                                <img class="card-img-top" src="{{asset('storage')}}/gameId{{$game->id}}.jpg">
                            </div>
                            <div class="col-md-10">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-6 gameCardName">
                                            <h4 class="card-title">{{$game->name}}</h4>
                                        </div>
                                        <div class="col-6 gameCardBtns">
                                            @if($user->role_id == 1)
                                                <a class="btn btn-primary" href="{{route('games.edit', $game->id)}}">Edit game</a>
                                            @endif
                                            @if($countIsPlayerInLobby == 0)
                                                <a class="btn btn-primary" href="{{route('battles.create', $game->id)}}">Create Battle</a>
                                            @endif
                                            @if($user->role_id == 1)
                                                <form method="post" action="{{route('games.destroy', $game->id)}}" id="destroyGame" class="destroyBtn">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary" onclick="document.getElementById('destroyGame').submit()"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted gamesplayer numberofplayer showGameText">{{$game->minPlayer}}-{{$game->maxPlayer}} players</h6>
                                    <h6 class="card-subtitle mb-2 text-muted gamesplayer duration showGameText">{{$game->duration}} min</h6>
                                    <p class="card-text text-justify">{{$game->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($game->Battle()->whereNull('wonBy')->get() as $battle)
                        <div class="col-md-10 lobbyCard">
                            <a data-toggle="collapse" href="#battle{{$battle->id}}" aria-expanded="true" aria-controls="collapseOne" class="list-group-item list-group-item-action flex-column align-items-start" >
                            <div class="row">
                                <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">
                                    {{$battle->Battle_player()->first()->User()->first()->Player()->first()->nickname}}
                                </h6>
                                <h6 class="card-title col-md-4 cardLobbyList">{{$battle->battleName}}</h6>
                                <h6 class="card-subtitle col-md-4 text-muted cardLobbyList">{{date('d-m-Y  H:m', strtotime($battle->created_at))}}</h6>
                            </div>
                            </a>
                        </div>
                        <div id="battle{{$battle->id}}" class="col-md-10 lobbyCard collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-body col-md-10">
                                  <div class="card-body">
                                      <div class="row">
                                      @foreach($battle->Battle_player()->get() as $battlePlayer )
                                          <div class="col-md-12">
                                              <div class="row">
                                                <h6>Player{{$loop->iteration}}:
                                                    {{$battlePlayer->User()->first()->Player()->first()->nickname}} </h6>
                                              </div>
                                          </div>
                                      @endforeach
                                      </div>
                                      @if($countIsPlayerInLobby == 0 && $battle->Battle_player()->count() <= $game->maxPlayer)
                                          <div class="col-md-12">
                                                  <form method="post" action="{{route('battle_players.store'), $battle->id}}" id="battleJoinForm">
                                                      @csrf
                                                      <input type="hidden" name="battle_id" value="{{$battle->id}}">
                                                      <div class="form-group row">
                                                          <div class="col-sm-11 offset-sm-5 gamesInput">
                                                              <a class="btn btn-primary" onclick="document.getElementById('battleJoinForm').submit()">Join battle</a>
                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>
                                      @endif
                                  </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection