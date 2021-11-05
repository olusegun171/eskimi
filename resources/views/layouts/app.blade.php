<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/basic.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/dropzone.js')}}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-no-wrap min-h-screen">
            @include('layouts.sidebar')

        <div id="app" class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
            <div class="w-full h-full rounded ">
                {{ $slot }}
            </div>
        </div>
    </div>
    </body>
</html>




