@extends('layouts.app')

@section('content')


    <img src="{{ asset('img/diablo-logo-show.png') }}" class="porfile_diablo_logo" alt="Das Logo von DIablo 3 Reaper of Souls">


<div class="profile_cnt">

    <div class="">
        <div class="profile_name">
            <h3>
                Name
            </h3>
            <p>
                {{ $profileUser->name }}
            </p>
        </div>
        <div class="profile_items">
            <h4>Mitglied seit:</h4>
            <p>{{ $profileUser->created_at}}</p>
        </div>
    </div>

    @forelse ($activities as $date => $activity)
    <h4 class="datum">{{ $date }}</h4>

    @foreach($activity as $record)
        @if (view()->exists("profiles.activities.{$record->type}"))
            @include ("profiles.activities.{$record->type}", ['activity' => $record])
        @endif
    @endforeach
    @empty
        <p class="profile_leer">Dein Profil ist leer. Erstelle einen Beitrag oder kommentiere etwas!</p>
    @endforelse

</div>
@endsection