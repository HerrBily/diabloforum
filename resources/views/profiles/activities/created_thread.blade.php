@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} hat einen Beitrag erstellt
        <a href="{{ $activity->subject->path() }}">
            {{ $activity->subject->title }}
        </a>
    @endslot

    <!-- @slot('body')
        {{ $activity->subject->body }}
    @endslot -->


@endcomponent
