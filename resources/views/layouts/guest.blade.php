<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: var(--background); color: var(--foreground);">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-6">
                <a href="/">
                    <img src="{{ asset('assets/img/favicon.png') }}" alt="JRonnie" class="w-16 h-16 rounded-2xl shadow-lg">
                </a>
            </div>

            <div style="background: var(--card); border: 1px solid var(--border); border-radius: 1.5rem; padding: 2rem; width: 100%; max-width: 28rem; box-shadow: var(--shadow-glow);">
                {{ $slot }}
            </div>

            <p class="mt-6 text-sm" style="color: var(--muted-foreground);">
                &copy; {{ date('Y') }} Jjuuko Ronald. All rights reserved.
            </p>
        </div>
    </body>
</html>
