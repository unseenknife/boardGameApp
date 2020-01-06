@extends('layouts.extends')

@section('content')
    <div class="main">
        <div class="containerLogin">
                <div class="middle">
                    <div id="login">

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            <fieldset class="clearfix">

                                <p>
                                    <span class="fa fa-envelope"></span>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" Placeholder="E-mail" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <p>
                                    <span class="fa fa-lock"></span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" Placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>

                                <div>

                                    <a class="btn btn-primary btnLoginRegister" onclick="document.getElementById('loginForm').submit()">Login</a>
                                    <a class="btn btn-primary btnLoginRegister" href="{{route('register')}}">Register</a>
                                </div>
                            </fieldset>
                            <div class="clearfix"></div>
                        </form>

                        <div class="clearfix"></div>

                    </div> <!-- end login -->
                    <div class="logo">Boardgames!

                        <div class="clearfix"></div>
                    </div>
                </div>
        </div>
    </div>
@endsection
