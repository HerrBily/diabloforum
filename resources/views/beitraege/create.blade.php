@extends('layouts.app')

@section('content')

<div class="create_cnt">
    <h3>Neuen Beitrag erstellen:</h3>

        <form method="POST" action="/beitraege">
            {{ csrf_field() }}

            <div class="category_input">
                <label for="category_id">Welche Kategorie hat dieser Beitrag?</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Wähle eine Kategorie</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="titel_input">
                <label for="title">Titel des Beitrags</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Titel ..." required>
            </div>

            <div class="text_input">
                <label for="body">Beitragstext</label>
                <textarea name="body" id="body" rows="10" required>{{ old('body') }}</textarea>
            </div>

            <div class="create_btn">
                <button type="submit">Beitrag erstellen</button>
            </div>

            @if (count($errors))
            <ul class="aler alert-danger">
                @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
            @endif

        </form>
</div>
@endsection