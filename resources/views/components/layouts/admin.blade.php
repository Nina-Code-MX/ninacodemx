@php $lang = \Cookie::get('lang') ?: config('app.locale'); @endphp 
@php $lang_available = config('app.locale_available') ?? ['es' => 'Español']; @endphp 
@php $lang_codes = config('app.locale_codes') ?? ['es' => 'mx']; @endphp 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $pageTitle ?? env('APP_NAME', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        @vite('resources/css/admin.css') 
        @livewireStyles 
        @stack('styles') 
    </head>

    <body class="antialiased bg-neutral-200">
        <div class="relative">
            <nav id="mainNav" class="bg-neutral-50 h-14 fixed left-0 lg:h-screen lg:w-64 top-0 right-0 w-full">
                <div class="flex gap-4 h-14 items-center justify-between lg:h-14 px-4">
                    <a href="#"><img class="border max-h-12 lg:max-h-16 rounded-full" src="{{ asset('images/logo-ninacode-mx-128.png') }}" /></a>
                    <h1 class="font-semibold text-sm">{{ env('APP_NAME', 'Laravel') }}</h1>
                    <span class="grow">&nbsp;</span>
                    <button id="mainNavBurger" class="border border-neutral-500 flex items-center lg:hidden rounded text-neutral-500"><span class="material-symbols-outlined">menu</span></button>
                </div>

                <ol class="bg-neutral-50 hidden lg:block lg:w-64 w-screen toggle-show">
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('home', ['locale' => $lang]) }}">Public site</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.contact.listing') }}">{{ __('Contacto') }}</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.portfolio.listing') }}">{{ __('Portafolio') }}</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.team.listing') }}">{{ __('Equípo') }}</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.service.listing') }}">{{ __('Servicio') }}</a></li>
                    <li class="w-full"><a class="border block px-4 py-2 w-full" href="{{ route('admin.translate.listing') }}">{{ __('Traducir') }}</a></li>
                </ol>
            </nav>

            <main class="ml-0 mt-14 lg:ml-72 lg:mr-10 lg:mt-0">
                <div class="flex flex-col h-screen-admin lg:h-screen-admin">
                    <div class="grow lg:px-0 px-2">
                        {{ $slot }}
                    </div>

                    <footer class="flex flex-col font-thin gap-1 items-center text-center text-neutral-600">
                        <div>Nina Code &copy; {{ date('Y') }}, todos los derechos reservados.</div>
                        <div>Imágenes por <a href="https://pixabay.com/users/startupstockphotos-690514/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380" target="_external">StartupStockPhotos</a> desde <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380" target="_external">Pixabay</a></div>
                        
                    </footer>
                </div>
            </main>
        </div>

        @vite('resources/js/admin.js') 
        @livewireScripts 
        @livewireScriptConfig 
        @stack('scripts') 
    </body>
</html>
