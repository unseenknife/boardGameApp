@extends('layouts.extends')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="containerLogin">
                    <div class="row">
                        <div class="card col-md-12 p-3">
                            <div class="row ">
                                <div class="col-md-10">
                                    <div class="card-block">
                                        <h4 class="card-title">Create a game</h4>
                                        <form method="post" action="{{route('games.store')}}" enctype="multipart/form-data" id="gameForm">
                                            @csrf
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Name:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="minPlayer" class="col-sm-3 col-form-label">{{ __('Min. player:') }}</label>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <input type="number" class="form-control{{ $errors->has('minPlayer') ? ' is-invalid' : '' }}" id="minPlayer" name="minPlayer" value="{{ old('minPlayer') }}">
                                                        </div>
                                                    </div>
                                                    <label for="maxPlayer" class="col-sm-3 col-form-label labelMaxPlayer">{{ __('Max. player:') }}</label>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <input type="number" class="form-control{{ $errors->has('maxPlayer') ? ' is-invalid' : '' }}" id="maxPlayer" name="maxPlayer" value="{{ old('maxPlayer') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="duration" class="col-sm-3 col-form-label">{{ __('Duration:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" id="duration" name="duration" placeholder="in minutes" value="{{ old('duration') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description" class="col-sm-3 col-form-label">{{ __('Description:') }}</label>
                                                    <div class="col-sm-9 gamesInput">
                                                        <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" value="{{ old('description') }}"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3 gamesInput">
                                                        <input type="file" class="form-control-file" name="file" id="file">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3 gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('gameForm').submit()">Save me!</a>
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