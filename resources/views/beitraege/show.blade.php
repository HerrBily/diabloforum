@extends('layouts.app')

@section('content')
<thread-view :init-replies-count="{{ $thread->replies_count }}" inline-template >
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> veröffentlichte:
                                {{ $thread->title }}
                            </span>
                            @can ('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-link">Beitrag löschen</button>
                            </form>
                            @endcan
                        </div>
                    </div>

                    <div class="panel-body text-truncate">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies :data="{{ $thread->replies }}" @added="repliesCount++" @removed="repliesCount--"></replies>
                
                {{ $replies->links() }}
                 

                
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        Der Beitrag wurde {{ $thread->created_at->diffForHumans() }} von
                        <a href="#">{{ $thread->creator->name }}</a>, und
                        hat <span v-text="repliesCount"></span>{{ str_plural('Kommentar', $thread->replies_count) }}.
                    </div>
                </div>
            </div>

        </div>
    </div>
</thread-view>
@endsection