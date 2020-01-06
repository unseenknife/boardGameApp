@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-10">
                                <div class="card-block">
                                    @if($battle->wonBy ==0)
                                        <div class="row marginBattle">
                                        @else
                                            <div class="row">
                                            @endif
                                                <div class="col-6 gameCardName">
                                                    <h4 class="card-title tittleGame">Battle: {{$battle->battleName}} ({{$battle_players->count()}}/{{$battle->Game()->first()->maxPlayer}})</h4>
                                                </div>
                                                <div class="col-6 gameCardBtns">
                                                    @if($first_player->player_id == Auth::id() && $battle->wonBy == 0)
                                                        @if($battle_players->count() >= $battle->Game()->first()->minPlayer)
                                                            <a class="btn btn-primary" href="{{route('battles.edit', $battle->id)}}">Start battle</a>
                                                        @endif
                                                        <form method="post" action="{{route('battles.destroy', $battle->id)}}" id="destroyBattle" class="destroyBtn">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="btn btn-primary btnCreateBattle destroyBtnBattle" onclick="document.getElementById('destroyBattle').submit()"><i class="fas fa-trash-alt"></i></a>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($battle->wonBy ==0)
                                                <h6 class="card-subtitle mb-2 text-muted">You are now in the lobby of the game {{$battle->Game()->first()->name}}. <br> Minimum players required: {{$battle->Game()->first()->minPlayer}}.</h6>
                                                @else
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-trophy"></i> {{$battle->Player()->first()->nickname}}<br>
                                                        For the game: {{$battle->Game()->first()->name}}. <br>
                                                        Played on: {{date('d-m-Y  H:m', strtotime($battle->updated_at))}}. <br>
                                                    </h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($battle_players as $battle_player)
                            <div class="row">
                                <div class="card col-md-10 p-3">
                                    <div class="row ">
                                        <div class="col-md-2">
                                            <img class="card-img-top" src="{{asset('storage')}}/playerId{{$battle_player->player_id}}.jpg">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-block">
                                                <h4 class="card-title">Player {{$loop->iteration}}: {{$battle_player->User()->first()->Player()->first()->nickname}}</h4>
                                                <h6 class="card-subtitle mb-2 player_{{$battle_player->User()->first()->Player()->first()->gameStatus}}"><i class="fas fa-circle"></i></i>{{$battle_player->User()->first()->Player()->first()->gameStatus}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
@endsection