@extends('layouts.app')

@section('content')
<div class="login_img_cnt">
    <img src="{{ asset('img/login-header.png') }}" alt="">
</div>

<div class="login_cnt">
    <div class="col-lg-4 login_form">
        <h2>Registrieren</h2>
        <form class="" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="textfield{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>

                <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="textfield{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" >E-Mail Adresse</label>


                <input id="email" type="email" placeholder="E-Mail" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

            </div>

            <div class="textfield{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Passwort</label>


                <input id="password" type="password" placeholder="Passwort" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>

            <div class="textfield">
                <label for="password-confirm">Passwort wiederholen</label>

                <input id="password-confirm" type="password" placeholder="Passwort wiederholen" name="password_confirmation" required>

            </div>

            <div class="login_btn">

                <button type="submit">
                    Registrieren
                </button>

            </div>
        </form>
    </div>
    <div class="register_sctn col-lg-6">
        <p>Ich habe bereits einen Account</p>
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>

@endsection