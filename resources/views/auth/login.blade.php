@extends('layouts.app')

@section('content')

<div class="login_img_cnt">
    <img src="{{ asset('img/login-header.png') }}" alt="">
</div>
<div class="login_cnt">
    <div class="col-lg-4 login_form">
        <h2>Login</h2>
        <form class="" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="textfield{{ $errors->has('email') ? ' has-error' : '' }}">

                <label for="email" class="">E-Mail Adresse</label>

                <input id="email" type="email" name="email" placeholder="E-Mail" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="textfield{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="">Passwort</label>

                <input id="password" type="password" placeholder="Passwort" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                    Angemeldet bleiben
                </label>
            </div>


            <div class="login_btn">
                <button type="submit">
                    Login
                </button>

                <a href="{{ route('password.request') }}">
                    Passwort vergessen?
                </a>
            </div>

        </form>

    </div>
    <div class="register_sctn col-lg-6">
        <p>Ich habe noch keinen Account</p>
        <a href="{{ route('register') }}">Registrieren</a>
    </div>
</div>

@endsection