@component('profiles.activities.activity')

    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}" class="activity_items">
        <p>
            {{ $profileUser->name }} favorisierte ein Kommentar
        </p>
        </a>
       
    @endslot

    <!-- @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot -->


@endcomponent

