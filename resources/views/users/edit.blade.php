@extends('layouts.extends')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="containerLogin editUser">
                    <div class="row">
                        <div class="card col-md-12 p-3">
                            <div class="row ">
                                <form method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data" id="userForm" class="formEditUser">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-10">
                                        <div class="card-block">
                                            <!-- card titel laat hier de gamenaam zien-->
                                            <h4 class="card-title center">{{$user->f_name . " " . $user->l_name}}</h4>
                                            <div class="alert-danger">
                                                <ul class="list-group">
                                                    @foreach($errors->all() as $error)
                                                        <li class="list-group-item-danger">{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <p class="card-text text-justify">
                                                <div class="form-group row">
                                                    <label for="f_name" class="col-sm-3 col-form-label">{{ __('First name:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" id="f_name" name="f_name" value="{{$user->f_name}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="l_name" class="col-sm-3 col-form-label">{{ __('Last name:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="text" class="forumInput form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" id="l_name" name="l_name" value="{{$user->l_name}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 col-form-label">{{ __('E-mail:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{$user->email}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password" class="col-sm-3 col-form-label">{{ __('Password:') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <input type="password" class="pwEditUser form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="form-group row">--}}
                                                    {{--<label for="password-confirm" class="col-sm-3 col-form-label">{{ __('Confirm Password:') }}</label>--}}
                                                    {{--<div class="col-sm-9">--}}
                                                        {{--<div class="row">--}}
                                                            {{--<input id="password-confirm" type="password" class="pwEditUser form-control" name="password_confirmation" required>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3 gamesInput">
                                                        <a class="btn btn-primary" onclick="document.getElementById('userForm').submit()">Save changes</a>
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