@component('profiles.activities.activity')

    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}">
        {{ $profileUser->name }} favorisierte ein Kommentar
        </a>
       
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot


@endcomponent

