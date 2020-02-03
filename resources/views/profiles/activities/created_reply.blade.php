@component('profiles.activities.activity')

    @slot('heading')
        <p>
            {{ $profileUser->name }} kommentierte den Beitrag von
        </p>
        <a href="{{ $activity->subject->thread->path() }}" class="activity_items">
            {{ $activity->subject->thread->title }}
        </a>
    @endslot

    <!-- @slot('body')
        {{ $activity->subject->body }}
    @endslot -->

@endcomponent

