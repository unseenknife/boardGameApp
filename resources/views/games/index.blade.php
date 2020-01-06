@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 p-3">
                        <div class="col-md-12 center">
                            @if($user->role_id == 1)
                                <a class="btn btn-primary" href="{{route('games.create')}}">Create a game</a>
                            @endif
                        </div>
                    </div>
                </div>
                @foreach ($games as $game)
                <div class="row">
                    <div class="card col-md-10 p-3">
                        <div class="row ">
                            <div class="col-md-2">
                                <img class="card-img-top" src="{{asset('storage')}}/gameId{{$game->id}}.jpg">
                            </div>
                            <div class="col-md-10">
                                <div class="card-block">
                                    <h4 class="card-title">{{$game->name}}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted gamesplayer numberofplayer">{{$game->minPlayer}}-{{$game->maxPlayer}} players</h6>
                                    <h6 class="card-subtitle mb-2 text-muted gamesplayer duration">{{$game->duration}} min</h6>
                                    <p class="card-text text-justify">{{$game->description}}</p>
                                    <a class="btn btn-primary" href="{{route('games.show', $game->id)}}"> Play a game!</a>
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