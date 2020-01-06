@extends('layouts.extends')

@section('content')

    <div class="main">
        <div class="containerLogin">
            <div class="middle">
                <div class="logo registerLogo">Boardgames!

                    <div class="clearfix"></div>
                </div>

                <div id="register">

                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <fieldset class="clearfix">

                            <p>
                                <span class="fas fa-user"></span>
                                <input id="f_name" type="text" class="form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" name="f_name" value="{{ old('f_name') }}" Placeholder="First name" required autofocus>
                                @if ($errors->has('f_name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('f_name') }}</strong>
                                        </span>
                                @endif
                            </p>
                            <p>
                                <span class="fas fa-user"></span>
                                <input id="l_name" type="text" class="form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" name="l_name" value="{{ old('l_name') }}" Placeholder="Last name" required>
                                @if ($errors->has('l_name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                @endif
                            </p>
                            <p>
                                <span class="fas fa-user-tag"></span>
                                <input id="nickname" type="text" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ old('nickname') }}" Placeholder="Nickname" required>
                                @if ($errors->has('nickname'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                @endif
                            </p>
                            <p>
                                <span class="fa fa-envelope"></span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" Placeholder="E-mail" required>
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
                            <p>
                                <span class="fa fa-lock"></span>
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" Placeholder="Password confirm" required>
                            </p>

                            <div>
                                <a class="btn btn-primary btnLoginRegister" href="{{route('login')}}">Back to login</a>
                                <a class="btn btn-primary btnLoginRegister" onclick="document.getElementById('registerForm').submit()">Register</a>

                            </div>
                        </fieldset>
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
