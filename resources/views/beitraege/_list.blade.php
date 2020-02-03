@forelse ($threads as $thread)
<div class="posting_cnt">
    <div class="row posting_items">
        <div class="col-lg-2">
            <h4>
                <a href="{{ route('profile', $thread->creator) }}">
                    {{ $thread->creator->name }}
                </a>
            </h4>
            <p class="date">
                {{ $thread->created_at->format('d.m.y H:i') }}
            </p>
        </div>

        <div class="col-lg-7 body">
            <h5>
                <a href="{{ $thread->path()  }}">
                    @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                    {{ $thread->title }}
                    @else
                    {{ $thread->title }}

                    @endif
                </a>
            </h5>

            <p>
                {{ $thread->body }}
            </p>
           

        </div>
        <div class="col-lg-3 comments">
            <a href="{{ $thread->path() }}"> {{ $thread->category->name }}</a>
            <a href="{{ $thread->path() }}">
                {{ $thread->replies_count }} {{ 'Kommentare', $thread->replies_count }}
            </a>
        </div>
    </div>
</div>
@empty
<p class="beitrag_leer">Keine Beiträge gerade vorhanden </p>
@endforelse