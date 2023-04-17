<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pageTitle ?? env('APP_NAME', 'Laravel') }}</title>

        @vite('resources/css/auth.css') 
        @livewireStyles 
        @stack('styles') 

        <script src="https://www.google.com/recaptcha/enterprise.js?render={{ env('GOOGLE_RECAPTCHA_KEY', '') }}"></script>
    </head>

    <body class="antialiased bg-neutral-200">
        <header></header>

        <div id="bodyContainer">
            {{ $slot }} 
        </div>

        <footer></footer>

        @vite('resources/js/auth.js') 
        @livewireScripts 
        @stack('scripts') 
    </body>
</html>
