@extends('layouts.app')

@section('content')
<div class="index_header_img">
    <img src="{{ asset('img/diablobeitrag.png') }}" alt="">
</div>
<div>
    <div class="new_btn_cnt">
        <a href="/beitraege/create" class="new_btn"><span class="fas fa-plus"></span> Neuer Beitrag</a>
    </div>
</div>

<section class="col-lg-12 main_cnt">
    <div class="col-lg-2 category_cnt">
        
        <a href="/beitraege" class="all_posting_btn">Alle Beiträge</a>

        @foreach ($categories as $category)
            <div class="category_btn">
                <a href="/beitraege/{{ $category->name }}" class="">
                    {{ $category->name }}
                </a>
            </div>
        @endforeach
     
        <!-- @foreach ($categories as $category)

        <a href="/beitraege/{{ $category->name }}" class="">
            {{ $category->name }}
        </a>

        @endforeach -->
    </div>
    <div class="col-lg-10 beitrag_cnt">

        @include ('beitraege._list')

        {{ $threads->links() }}
    </div>
</section>
@endsection