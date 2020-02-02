@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h3>
                    Name
                </h3>
                <h4>
                    {{ $profileUser->name }}
                </h4>
                <p>Mitglied seit: {{ $profileUser->created_at}}</p>
            </div>

            @forelse ($activities as $date => $activity)
                <h3 class="page-header">{{ $date }}</h3>

                @foreach($activity as $record)
                    @if (view()->exists("profiles.activities.{$record->type}"))
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            @empty
                <p>Dein Profil ist leer. Erstelle einen Beitrag oder kommentiere etwas!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection