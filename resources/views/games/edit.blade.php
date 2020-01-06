@extends('layouts.extends')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="containerLogin">
                    <div class="row">
                        <div class="card col-md-12 p-3">
                            <div class="row ">
                                <form method="post" action="{{route('games.update', $game->id)}}" enctype="multipart/form-data" id="gameForm">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-2 image-upload">
                                        <label for="file">
                                            <img class="card-img-top" src="{{asset('storage')}}/gameId{{$game->id}}.jpg">
                                        </label>
                                        <input class="displayFileInput" id="file" name="file" type="file">
                                    </div>
                                <div class="col-md-10">
                                    <div class="card-block">
                                        <!-- card titel laat hier de gamenaam zien-->
                                        <h4 class="card-title center">Update {{$game->name}}</h4>
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Name:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{$game->name}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="minPlayer" class="col-sm-3 col-form-label">{{ __('Min. player:') }}</label>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <input type="number" class="form-control{{ $errors->has('minPlayer') ? ' is-invalid' : '' }}" id="minPlayer" name="minPlayer" value="{{$game->minPlayer}}">
                                                        </div>
                                                    </div>
                                                    <label for="maxPlayer" class="col-sm-3 col-form-label labelMaxPlayer">{{ __('Max. player:') }}</label>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <input type="number" class="form-control{{ $errors->has('maxPlayer') ? ' is-invalid' : '' }}" id="maxPlayer" name="maxPlayer" value="{{$game->maxPlayer}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="duration" class="col-sm-3 col-form-label">{{ __('Duration:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" id="duration" name="duration" placeholder="in minutes" value="{{$game->duration}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description" class="col-sm-3 col-form-label">{{ __('Description:') }}</label>
                                                    <div class="col-sm-9 gamesInput">
                                                        <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="5">{{$game->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3 gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('gameForm').submit()">Save me!</a>
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