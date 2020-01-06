@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                @foreach ($players as $player)
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-2">
                                <img class="card-img-top" src="{{asset('storage')}}/playerId{{$player->id}}.jpg">
                            </div>
                            <div class="col-md-10">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-6 gameCardName">
                                            <h4 class="card-title">{{$player->nickname}}</h4>
                                        </div>
                                        <div class="col-6 gameCardBtns">
                                                <a class="btn btn-primary" href="{{route('players.show', $player->id)}}">Show profile</a>
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle mb-2 player_{{$player->gameStatus}}"><i class="fas fa-circle"></i></i>{{$player->gameStatus}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection