@php
    $lang_available = config('app.locale_available') ?? ['es' => 'Español'];
    $lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];
    $lang = \Cookie::get('lang') ?: config('app.locale') ?: 'es';
    $lang = in_array($lang, array_keys($lang_available)) ? $lang : 'es';
    app()->setLocale($lang);
@endphp 
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

                <ol class="bg-neutral-50 hidden lg:block lg:pt-10 lg:w-64 w-screen toggle-show">
                    @php
                        $menuItems = [
                            ['icon' => 'public',          'name' => __('Ver Sitio'),  'route' => route('home', ['locale' => $lang])],
                            ['icon' => 'empty_dashboard', 'name' => __('Dashboard'),  'route' => route('admin.dashboard')],
                            ['icon' => 'contact_support', 'name' => __('Contacto'),   'route' => route('admin.contact.listing')],
                            ['icon' => 'auto_stories',    'name' => __('Portafolio'), 'route' => route('admin.portfolio.listing')],
                            ['icon' => 'groups',          'name' => __('Equípo'),     'route' => route('admin.team.listing')],
                            ['icon' => 'devices',         'name' => __('Servicio'),   'route' => route('admin.service.listing')],
                            ['icon' => 'translate',       'name' => __('Traducir'),   'route' => route('admin.translate.listing')]
                        ];
                    @endphp 
                    @foreach ($menuItems as $item)
                    <li class="border border-b-0 w-full">
                        <a class="block flex gap-4 hover:bg-neutral-200 items-center justify-between px-4 py-2 w-full" href="{{ $item['route'] }}">
                            <span>{{ $item['name'] }}</span>
                            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                        </a>
                    </li>
                    @endforeach 

                    <li class="border w-full">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="flex gap-4 hover:bg-neutral-200 items-center justify-between px-4 py-2 text-left w-full" type="submit">
                                <span>{{ __('Cerrar sesión') }}</span>
                                <span class="material-symbols-outlined">logout</span>
                            </button>
                        </form>
                    </li>
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
