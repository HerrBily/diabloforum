@extends('layouts.app')

@section('content')
<thread-view :init-replies-count="{{ $thread->replies_count }}" inline-template>
    <div>
        <div class="show_img_cnt">
            <img src="{{ asset('img/diablo-logo-show.png') }}" alt="Das Logo von Diablo 3 Reaper of Souls">
        </div>
        <div class="col-lg-12 show_cnt">

            <div class="show_beitrag">
                <div class="profil_cnt">
                    <div>
                        <h5>
                            <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                        </h5>
                        <p class="date">
                            {{ $thread->created_at->format('d.m.y H:i') }}
                        </p>

                    </div>

                </div>

                <div>
                    <h5>
                        <a href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                    </h5>
                    <p>
                        {{ $thread->body }}
                    </p>
                </div>
            </div>
            @can ('update', $thread)
            <form action="{{ $thread->path() }}" method="POST" class="posting_delete">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit">Beitrag löschen</button>
            </form>
            @endcan

        </div>
        <p class="comment_header">Kommentare</p>
        <div class="col-lg-12 new_reply_cnt">
         
                <replies :data="{{ $thread->replies }}" @added="repliesCount++" @removed="repliesCount--"></replies>
            
            
        </div>

        {{ $replies->links() }}

    </div>


</thread-view>
@endsection