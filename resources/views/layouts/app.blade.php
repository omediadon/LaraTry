<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex flex-column">

    @include('layouts.partials.navigation')

    @yield('header')

    <main class="container py-4 flex-fill">
        @yield('content')
    </main>

    <footer class="container-fluid w-100 bg-dark text-light py-4">
        <div class="container">
            @section('footer')
                <p class="m-0 text-center text-white">{!! __('app.copyright') !!} {{ config('app.name', 'Laravel') }}  {{ now()->year }}</p>
            @show
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
@stack('js')
</body>
</html>
