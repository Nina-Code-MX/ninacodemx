<div>
    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="h-32 w-52">
                    <img alt="{{ $services['name'] }}" class="object-cover h-full rounded" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="{{ $services['name'] }}" />
                </div>

                <h1>{{ $services['name'] }}</h1>
            </div>
        </div>
    </div>

    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            @php $paragraph = preg_replace(['/\n/', '/\|{2,}/'], ['|', '|'], $services['description']); @endphp
            @foreach (explode('|', $paragraph) ?? [] as $p) 
            <p class="mb-4">{{ $p }}</p>
            @endforeach 

            <a class="button-secondary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100"
                href="{{ route(app()->getLocale() . '.services', ['locale' => app()->getLocale()]) }}">{{ __('Volver') }}</a>
        </div>
    </div>
</div>
