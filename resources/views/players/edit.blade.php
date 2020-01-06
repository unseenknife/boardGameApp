@extends('layouts.extends')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="containerLogin editUser">
                    <div class="row">
                        <div class="card col-md-12 p-3">
                            <div class="row ">
                                <form method="post" action="{{route('players.update', $player->id)}}" enctype="multipart/form-data" id="playerForm" class="formEditUser">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-2 image-upload">
                                        <label for="file">
                                            <img class="card-img-top" src="{{asset('storage')}}/playerId{{$player->id}}.jpg">
                                        </label>
                                        <input class="displayFileInput" id="file" name="file" type="file" >
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-block">
                                            <h4 class="card-title center">{{$player->nickname}}</h4>
                                            @if($player->gameStatus == 'online')
                                                <div class="card-subtitle mb-2 player_{{$player->gameStatus}} statusPlayer center">
                                                    <input name="gameStatus" type="hidden" value="away">
                                                    <a onclick="document.getElementById('playerForm').submit()">
                                                        <i class="fas fa-circle"></i>{{$player->gameStatus}}
                                                    </a>
                                                </div>
                                            @endif
                                            @if($player->gameStatus == 'away')
                                                <div class="card-subtitle mb-2 player_{{$player->gameStatus}} statusPlayer center">
                                                    <input name="gameStatus" type="hidden" value="online">
                                                    <a class="card-subtitle mb-2 player_{{$player->gameStatus}} statusPlayer center" onclick="document.getElementById('playerForm').submit()">
                                                        <i class="fas fa-circle"></i>{{$player->gameStatus}}
                                                    </a>
                                                </div>
                                            @endif
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label for="nickname" class="col-sm-3 col-form-label">{{ __('Nickname:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" id="nickname" name="nickname" value="{{$player->nickname}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{__('Cursors:')}}</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4 cursor">
                                                                    <label for="cursor1">
                                                                        <img  src="{{asset('img')}}/cursorSetting1.png">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4 cursor">
                                                                    <label for="cursor2">
                                                                        <img  src="{{asset('img')}}/cursorSetting2.png">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 cursor">
                                                                    <input class="cursorSelect" type="radio" name='cursor' id="cursor1" value="1" @if($player->cursor == 1) checked="checked" @endif>
                                                                </div>
                                                                <div class="col-sm-4 cursor">
                                                                    <input class="cursorSelect" type="radio" name='cursor' id="cursor2" value="2" @if($player->cursor == 2) checked="checked" @endif>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 center gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('playerForm').submit()">Save changes</a>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection