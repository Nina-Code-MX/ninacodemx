<x-layouts.app>
    <div class="container mx-auto pt-10 px-4">
        <div class="flex flex-col items-center justify-center h-full">
            <h1 class="color-primary text-4xl font-bold">404</h1>
            <p class="text-gray-600">{{ __('Página no encontrada') }}</p>
            <code class="break-all italic text-xs whitespace-pre-wrap text-center w-full">{{ url()->current() }}</code>
            <p>&nbsp;</p>
            <a href="javascript:history.back()" class="button-primary border font-bold inline-block mb-2 mx-auto px-4 py-2 rounded text-slate-100">{{ __('Volver') }}</a>
        </div>
    </div>
</x-layouts.app>