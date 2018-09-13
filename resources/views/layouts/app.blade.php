<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', 'Laravel Podcast') }}</title>

        {{-- Styles --}}
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

        @yield('header-style')

        {{-- Scripts --}}
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body class="@if (trim($__env->yieldContent('template_body_classes')))@yield('template_body_classes')@endif">
        <div id="app">

            @include('partials.nav')
            @yield('content')

        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
        @yield('footer-scripts')

    </body>
</html>