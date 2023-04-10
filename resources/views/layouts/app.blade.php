<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pageTitle ?? env('APP_NAME', 'Laravel') }}</title>

        @vite('resources/css/app.css') 
        @livewireStyles 
        @stack('styles') 

        <script src="https://www.google.com/recaptcha/enterprise.js?render={{ env('GOOGLE_RECAPTCHA_KEY', '') }}"></script>
    </head>

    <body class="antialiased bg-neutral-200">
        <nav class="bg-navbar duration-500 ease-in-out fixed font-bold h-16 transition w-full z-50" id="mainNavBar">
            <div class="container flex flex-wrap items-center justify-between mx-auto px-4 text-neutral-100">
                <a class="flex gap-4 h-16 items-center w-16 p-1" href="{{ env('APP_URL', 'http://localhost') }}">
                    <img src="{{ asset('images/logo-ninacode-mx-1024.png') }}" class="h-fit w-fit" alt="Nina Code" />
                    <span class="whitespace-nowrap">{{ env('APP_NAME', 'Laravel') }}</span>
                </a>

                <button aria-controls="mainNavBar-toggle" aria-expanded="false" class="hover:text-neutral-400 lg:hidden ring-2 ring-neutral-100 rounded" data-collapse-toggle="mainNavBar-toggle" type="button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>

                <div class="hidden lg:block lg:w-auto w-full" id="mainNavBar-toggle">
                    <ul class="flex flex-col lg:flex-row lg:space-x-8">
                        <li><a class="hover:text-neutral-50" href="#">Inicio</a></li>
                        <li><a class="hover:text-neutral-50" href="#">Nosotros</a></li>
                        <li><a class="hover:text-neutral-50" href="#">Portafolio</a></li>
                        <li><a class="hover:text-neutral-50" href="#">Servicios</a></li>
                        <li><a class="hover:text-neutral-50" href="#">Precios</a></li>
                        <li><a class="hover:text-neutral-50" href="#">Contacto</a></li>
                    </ul>
                </div>
            </div>
            {{--
            <div class="container flex flex-wrap items-start justify-between mx-auto p-4">
                <a href="{{ env('APP_URL', 'http://localhost') }}" class="bg-primary flex h-[82px] items-start -mt-1 relative rounded-full shadow w-[82px]" id="mainNavBarBrand">
                    <img src="{{ asset('images/logo-ninacode-mx-1024.png') }}" class="absolute h-[80px] left-0 m-[1px] top-0" alt="Nina Code" />
                    <span class="block font-semibold ml-[88px] mt-1 self-start text-2xl whitespace-nowrap">Nina Code</span>
                </a>

                <button data-collapse-toggle="navbar-default" type="button" class="focus:outline-none focus:ring-2 focus:ring-gray-200 hover:bg-gray-100 inline-flex items-center md:hidden ml-3 p-2 rounded-lg text-neutral-800 text-sm" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>

                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                        </li>

                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                        </li>

                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                        </li>

                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
                        </li>

                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            --}}
        </nav>

        <div class="h-screen max-h-[563px] relative sm:max-h-[563px]">
            <div class="absolute h-screen hero max-h-[563px] opacity-80 w-full -z-10">
            </div>

            <div class="container mx-auto z-10">
                <div class="h-16 w-full"></div>

                <div class="gap-6 flex flex-col items-center justify-center sm:flex-row sm:h-screen sm:items-left sm:max-h-[500px]">
                    <div class="flex flex-col items-left justify-left sm:h-screen sm:justify-center sm:max-h-[500px] sm:w-1/2">
                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 border-t border-t-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <h1>Diseño de páginas web</h1>
                        </div>

                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <h2>Infraestructura, Diseño de páginas web, SEO & SEM</h2>
                        </div>

                        <div class="bg-[#f5f5f5e0] border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <p>Te migramos a la Nube, alcanza mas clientes, te posicionamos donde debes estar. Deja que profesionales manejen el mundo digita del tu negocio.</p>
                        </div>

                        <div class="bg-[#f5f5f5e0] border-b border-b-neutral-200 border-l border-l-neutral-200 border-r border-r-neutral-200 px-4 py-2 sm:px-6 sm:py-2">
                            <a class="button-primary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100" href="#">Contactanos</a>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-left sm:h-screen sm:justify-center sm:max-h-[500px] sm:w-1/2">
                        <div class="max-w-[50%]">
                            <img alt="{{ env('APP_NAME', 'Laravel') }}" class="max-h-[250px]" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="bodyContainer">
            {{ $slot }} 
        </div>

        <footer class="bg-neutral-100 border-t border-t-neutral-200 text-xs mt-auto p-2">
            <div class="gap-4 grid grid-cols-2 sm:gap-6 sm:grid-cols-4">
                <div>
                    <h4 class="mb-4">Información de contacto</h4>

                    <ul>
                        <li class="p-1">Castilla la Mancha 68</li>
                        <li class="p-1">Zapopan, Jalisco, México.</li>
                        <li class="p-1">contacto@ninacode.mx</li>
                        <li class="p-1 ">+52 33 3902 5911</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Mapa del Sitio</h4>

                    <ul>
                        <li class="p-1">Inicio</li>
                        <li class="p-1">Nosotros</li>
                        <li class="p-1">Portafolio</li>
                        <li class="p-1">Servicios</li>
                        <li class="p-1">Precios</li>
                        <li class="p-1">Contacto</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Enlaces de interés</h4>

                    <ul>
                        <li class="p-1">Políticas de Privacidad</li>
                        <li class="p-1">Términos y Condiciones</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Redes Sociales</h4>

                    <ul>
                        <li class="p-1">Facebook</li>
                        <li class="p-1">Instagram</li>
                        <li class="p-1">Youtube</li>
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
        @stack('scripts') 
    </body>
</html>
