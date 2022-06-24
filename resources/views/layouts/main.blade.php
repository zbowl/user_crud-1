<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'User-Crud') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- must be added in order for the x-cloak html tag to work for alpinejs -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Livewire styles -->
    @livewireStyles

    <!-- Place for custom styles to be pushed from component -->
    @stack('styles')
</head>
<body class="antialiased">

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- banner/top-nav placeholder -->
    <nav class="w-full pt-10 mt-10">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <a href="{{ url('/users') }}" class="mr-4 text-sm text-gray-700 dark:text-gray-500 underline">Users</a>
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>
    <!-- page content -->
    <main class="bg-gray-900 pt-10 mt-10">
        {{ $slot }}
    </main>
</div>

@stack('modals')

</body>

<!-- Livewire Scripts -->
@livewireScripts

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>

<!-- Place for custom scripts to be pushed from component -->
@stack('scripts')

</html>
