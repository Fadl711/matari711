<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> لوحة التحكم</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('includes.nav')
            @include('layouts.navigation')

            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                @if(!Request::is('profile'))
                @auth
                @if (Auth::user()->usertype=='admin')

                @include('posts.show_users')
                @else
                @endif
                @endauth
                @endif
                {{$slot}}
            </main>
        </div>
    </body>
</html>
