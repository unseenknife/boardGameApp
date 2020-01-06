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
                                        <h4 class="card-title">Create a game for {{$game->first()->name}}</h4>
                                        <form method="post" action="{{route('battles.store')}}" enctype="multipart/form-data" id="battleForm">
                                            @csrf
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label for="battleName" class="col-sm-3 col-form-label">{{ __('Battle name:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control" id="battleName" name="battleName" value="{{ old('battleName') }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="card-text text-justify">
                                            <input type="hidden" name="game_id" value="{{$game->first()->id}}">
                                        </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3 gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('battleForm').submit()">Save me!</a>
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