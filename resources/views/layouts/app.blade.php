<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        @include('flash::message')
        @include('layouts.navigation')
        <main class="max-w-screen-xl flex items-center justify-between p-4 mx-auto">
            {{ $slot }}
        </main>
        <script>
            setTimeout(function() {
                document.querySelector('div.alert').style.display = 'none';
            }, 3000);
        </script>
    </body>
</html>
