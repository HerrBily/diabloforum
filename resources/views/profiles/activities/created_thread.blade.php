@component('profiles.activities.activity')

    @slot('heading')
        <p>
            {{ $profileUser->name }} hat einen Beitrag erstellt
        </p>
        <a href="{{ $activity->subject->path() }}" class="activity_items">
            {{ $activity->subject->title }}
        </a>
    @endslot

    <!-- @slot('body')
        {{ $activity->subject->body }}
    @endslot -->


@endcomponent
