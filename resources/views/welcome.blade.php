@extends('layouts.app')

@section('content')
<!-- <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @if (Auth::check())
        <a href="{{ url('/home') }}">Home</a>
        @else
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
        @endif
    </div>
    @endif -->

<div class="index_header_img">
    <img src="img/diablo-header.png" alt="">
</div>
<div class="container diablo-cnt">
    <img src="img/diablocom.png" alt="">
    <h2>Das Communityforum für Diablo</h2>
</div>
<div class="diablo_img">
    <img src="img/Reaper.png" alt="">
</div>

<div class="welcome_btn_cnt">
    <a href="/beitraege" class="welcome_btn">Zu den Beiträgen</a>
</div>

<!-- <div class="container diablo_container">
    <h1 class="diablo_header">
        Diablocom
    </h1>
    <p>Herzlich Willkommen Abenteurer in der Community von Diablocom.</p>
    <p>Helft euch gegenseitig um die Dämonen wieder zurück in ihre Unterwelt zu schicken!</p>
</div> -->


@endsection