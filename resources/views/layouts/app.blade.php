<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Diablocom') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
          window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
        ]) !!};
    </script>

    <style>
        body { padding-bottom: 100px;}
        .level { display:flex; align-items: center;}
        .flex {flex: 1;}
        .mr-1 {margin-right: 1em; }
        [v-cloak] { display: none; }
    </style>

</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ei3lpbp74w96jdgaohvzzis7unvx3hhfvjs57yvc7vqw4eb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
tinymce.init({ 
    selector: 'textarea',
    setup: function (editor) {
        editor.on('change', function (e) {
            editor.save();
        });
    }
});
</script>
    @yield('scripts')
</body>
</html>
