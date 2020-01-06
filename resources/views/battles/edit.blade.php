@extends('layouts.extends')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="containerLogin createBattle">
                    <div class="row">
                        <div class="card col-md-12 p-3">
                            <div class="row ">
                                <div class="col-md-10">
                                    <div class="card-block">
                                        <h4 class="card-title">Battle: {{$battle->battleName}} result</h4>
                                        <form method="post" action="{{route('battles.update', $battle->id)}}" enctype="multipart/form-data" id="battleEditForm">
                                            @csrf
                                            @method('PATCH')
                                            <p class="card-text text-justify">
                                            <div class="col-sm-12 cursor">
                                                @foreach($battle->Battle_player()->get() as $battlePlayer)
                                                    <div class="form-group row">
                                                    <div class="row">
                                                        <div class="col-sm-2 battleWinnerButton">
                                                            <input class="cursorSelect" type="radio" name='wonBy' id="PlayerId{{$battlePlayer->player_id}}" value="{{$battlePlayer->player_id}}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img class="card-img-top" src="{{asset('storage')}}/playerId{{$battlePlayer->player_id}}.jpg">
                                                        </div>
                                                        <label for="PlayerId{{$battlePlayer->player_id}}" class="col-md-6 card-block card-title battleWinner">
                                                            {{$battlePlayer->User()->first()->Player()->first()->nickname}}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="form-group row">
                                                    <div class="col-sm-12 gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('battleEditForm').submit()">Save result</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection