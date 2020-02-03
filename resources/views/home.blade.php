@extends('layouts.app')

@section('content')

<div class="container welcome_cnt">
    <p>Willkommen bei Diablocom {{ Auth::user()->name }}</p>
   

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
<div class="welcome_img">
    <img src="{{ asset('img/diablo-welcome.png') }}" alt="Diablo 3 Bild mit Endboss Reaper">
</div>




@endsection