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
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content={{ csrf_token() }}>
        <title>{{ $pageTitle ?? __('Home') }} - {{ env('APP_NAME', 'Laravel') }}</title>

        @stack('meta') 

        @vite('resources/css/app.css') 
        @livewireStyles 
        @stack('styles') 

        <script src="https://www.google.com/recaptcha/enterprise.js?render={{ env('GOOGLE_RECAPTCHA_KEY', '') }}"></script>
        <script src="https://kit.fontawesome.com/0a6562d8bd.js" crossorigin="anonymous"></script>
    </head>

    <body class="antialiased bg-neutral-200">
        <nav class="bg-navbar duration-500 ease-in-out fixed font-bold h-16 transition w-full z-50" id="mainNavBar">
            <div class="flex flex-wrap items-center justify-between lg:container mx-auto text-neutral-100">
                <a class="flex gap-4 h-16 items-center ml-4 w-16 p-1" href="{{ env('APP_URL', 'http://localhost') }}">
                    <img src="{{ asset('images/logo-ninacode-mx-1024.png') }}" class="h-fit max-h-full w-fit" alt="Nina Code" />
                    <span class="whitespace-nowrap">{{ env('APP_NAME', 'Laravel') }}</span>
                </a>

                <button aria-controls="mainNavBar-toggle" aria-expanded="false" class="hover:text-neutral-400 lg:hidden mr-4 ring-2 ring-neutral-100 rounded" data-collapse-toggle="mainNavBar-toggle" type="button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>

                <div class="bg-primary hidden lg:bg-transparent lg:block lg:mr-4 lg:w-auto w-full" id="mainNavBar-toggle">
                    <ul class="bg-primary border-white divide-y flex flex-col gap-2 items-center lg:bg-transparent lg:divide-y-0 lg:flex-row lg:gap-0 lg:p-0 lg:space-x-8 p-4">
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route('home', ['locale' => $lang]) }}">{{ __('mainmenu.home') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route($lang . '.aboutus', ['locale' => $lang]) }}">{{ __('mainmenu.aboutus') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route($lang . '.portfolio', ['locale' => $lang]) }}">{{ __('mainmenu.portfolio') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route($lang . '.services', ['locale' => $lang]) }}">{{ __('mainmenu.services') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route($lang . '.pricing', ['locale' => $lang]) }}">{{ __('mainmenu.pricing') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full"><a class="hover:text-neutral-50" href="{{ route($lang . '.contact', ['locale' => $lang]) }}">{{ __('mainmenu.contact') }}</a></li>
                        <li class="lg:pt-0 lg:w-auto pt-2 w-full">
                            <button class="hover:text-neutral-50 focus:outline-none focus:ring-0 gap-2 inline-flex items-center"
                                data-dropdown-toggle="dropdownLangSwitcher"
                                id="langSwitcher"
                                type="button">
                                <span>{{ $lang_available[$lang] ?? 'Español' }}</span>
                                <span class="fi fi-{{ $lang_codes[$lang] ?? 'mx' }}"></span>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700" id="dropdownLangSwitcher">
                                <form action="/lang-switcher" id="lang_switcher_form" method="POST">
                                    @csrf
                                    <input id="lang_switcher_value" type="hidden" name="lang" value="{{ $lang }}" />

                                    <ul aria-labelledby="dropdownLangSwitcher" class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                        @forelse ($lang_available AS $code => $name)
                                        <li>
                                            <button class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 w-full"
                                                data-lang-switcher
                                                data-lang-value="{{ $code }}"
                                                type="button">{{ $name }} <span class="fi fi-{{ $lang_codes[$code] ?? 'mx' }}"></span></button>
                                        </li>
                                        @empty 
                                        <li>
                                            <button class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 w-full"
                                                data-lang-switcher
                                                data-lang-value="es"
                                                type="button">Español <span class="fi fi-mx"></span></button>
                                        </li>
                                        @endforelse 
                                    </ul>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(isset($heroData)) 
        <div class="md:h-screen md:max-h-[563px] relative">
            <div class="absolute h-screen hero md:max-h-[563px] opacity-80 w-full -z-10">
            </div>

            <div class="container mx-auto z-10">
                <div class="h-16 w-full"></div>
                <div class="gap-6 flex flex-col items-center justify-center sm:flex-row sm:h-screen sm:items-left sm:max-h-[500px]">
                    <div class="flex flex-col items-left justify-left sm:h-screen sm:justify-center sm:max-h-[500px] sm:w-1/2">
                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 border-t border-t-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <h1>{{ $heroData['h1'] ?? __('pages/home.hero.h1') }}</h1>
                        </div>

                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <h2>{{ $heroData['h2'] ?? __('pages/home.hero.h2') }}</h2>
                        </div>

                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <p>{{ $heroData['p'] ?? __('pages/home.hero.p') }}</p>
                        </div>

                        @if (isset($heroData['action']) && $heroData['action']) 
                        <div class="bg-[#f5f5f5e0] border-b border-b-neutral-200 border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <a class="button-primary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100"
                                href="{!! $heroData['action']['route'] ?? route('home', ['locale' => $lang]) !!}">{{ $heroData['action']['label'] ?? __('Contactenos') }}</a>
                        </div>
                        @endif 
                    </div>

                    <div class="flex flex-col items-center justify-left sm:h-screen sm:justify-center sm:max-h-[500px] sm:w-1/2">
                        <div class="max-w-[50%]">
                            <img alt="{{ env('APP_NAME', 'Laravel') }}" class="max-h-[250px]" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else 
        <div class="h-16 w-full"></div>
        @endif  

        <div id="bodyContainer">
            {{ $slot }} 
        </div>

        <footer class="bg-neutral-100 border-t border-t-neutral-300 text-xs mt-auto p-4">
            <div class="gap-4 grid grid-cols-2 sm:gap-6 sm:grid-cols-4">
                <div>
                    <h4 class="mb-4">{{ __('Información de contacto') }}</h4>

                    <ul>
                        <li class="p-1">Castilla la Mancha 68</li>
                        <li class="p-1">Zapopan, Jalisco, México.</li>
                        <li class="p-1">contacto@ninacode.mx</li>
                        <li class="p-1 ">+52 33 3902 5911</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">{{ __('Mapa del Sitio') }}</h4>

                    <ul>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route('home', ['locale' => $lang]) }}">{{ __('mainmenu.home') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.aboutus', ['locale' => $lang]) }}">{{ __('mainmenu.aboutus') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.portfolio', ['locale' => $lang]) }}">{{ __('mainmenu.portfolio') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.services', ['locale' => $lang]) }}">{{ __('mainmenu.services') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.pricing', ['locale' => $lang]) }}">{{ __('mainmenu.pricing') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.contact', ['locale' => $lang]) }}">{{ __('mainmenu.contact') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">{{ __('Enlaces de interés') }}</h4>

                    <ul>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.privacy', ['locale' => $lang]) }}">{{ __('mainmenu.privacy') }}</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="{{ route($lang . '.terms', ['locale' => $lang]) }}">{{ __('mainmenu.terms') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">{{ __('Redes Sociales') }}</h4>

                    <ul>
                        <li class="p-1"><a class="hover:font-semibold" href="https://www.facebook.com/ninacodemx">Facebook</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="https://www.instagram.com/ninacodemx/">Instagram</a></li>
                        <li class="p-1"><a class="hover:font-semibold" href="https://www.youtube.com/channel/UCoaWaOoAMzyf99D192HyMBQ">Youtube</a></li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col font-thin gap-1 items-center text-center text-neutral-600">
                <div>Nina Code &copy; {{ date('Y') }}, todos los derechos reservados.</div>
                <div>Imágenes por <a href="https://pixabay.com/users/startupstockphotos-690514/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380" target="_external">StartupStockPhotos</a> desde <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380" target="_external">Pixabay</a></div>
            </div>
        </footer>

        @vite('resources/js/app.js') 
        @livewireScripts 
        @livewireScriptConfig 
        @stack('scripts') 
    </body>
</html>
