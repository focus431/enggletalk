<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EnggleTalk</title>
    @viteReactRefresh
    @vite(['resources/js/app.js'])
    {{-- <link href="{{ asset('css/saga-blue/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/primeicons/primeicons.css') }}" rel="stylesheet"> --}}
    
</head>
<body>
    <div id="app"></div>
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
