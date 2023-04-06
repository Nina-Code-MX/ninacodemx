<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pageTitle ?? env('APP_NAME', 'Laravel') }}</title>

        @vite('resources/css/app.css') 
        @livewireStyles 
    </head>

    <body class="antialiased bg-neutral-200">
        <div class="h-screen max-h-[500px] relative sm:max-h-[500px]">
            <div class="absolute h-screen hero max-h-[500px] opacity-80 w-full -z-10">
            </div>

            <div class="container mx-auto z-10">
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
                            <a class="bg-[#4cb5ff] border font-bold hover:bg-[#5dc6ff] inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100" href="#">Contactanos</a>
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

        <div>
            {{ $slot }} 
        </div>

        <footer class="bg-neutral-100 border-t border-t-neutral-200 text-xs mt-auto p-2">
            <div class="gap-4 grid grid-cols-2 sm:gap-6 sm:grid-cols-4">
                <div>
                    <h4 class="mb-4">Información de contacto</h4>

                    <ul>
                        <li class="p-1 sm:p-2">Castilla la Mancha 68</li>
                        <li class="p-1 sm:p-2">Zapopan, Jalisco, México.</li>
                        <li class="p-1 sm:p-2">contacto@ninacode.mx</li>
                        <li class="p-1 sm:p-2">+52 33 3902 5911</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Derechos</h4>

                    <ul>
                        <li class="p-1 sm:p-2">Nina Code &copy; {{ date('Y') }}, todos los derechos reservados.</li>
                        <li class="p-1 sm:p-2">Imágenes por <a href="https://pixabay.com/users/startupstockphotos-690514/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380">StartupStockPhotos</a> desde <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=593380">Pixabay</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Enlaces de interés</h4>

                    <ul>
                        <li class="p-1 sm:p-2">Políticas de Privacidad</li>
                        <li class="p-1 sm:p-2">Términos y Condiciones</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4">Redes Sociales</h4>

                    <ul>
                        <li class="p-1 sm:p-2">Facebook</li>
                        <li class="p-1 sm:p-2">Instagram</li>
                        <li class="p-1 sm:p-2">Youtube</li>
                    </ul>
                </div>
            </div>
        </footer>
        @livewireScripts 
    </body>
</html>
