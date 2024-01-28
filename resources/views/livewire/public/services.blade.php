<div>
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                @forelse ($services as $service)
                @php
                    if ($service['image']) {
                        $service['image'] = \Storage::url($service['image']);
                    } else {
                        $service['image'] = 'images/logo-ninacode-mx-1024.png';
                    }
                @endphp
                <div class="bg-neutral-100 flex gap-4 p-4 place-self-stretch rounded">
                    <div class="h-32 w-52">
                        <img alt="{{ $service['name'] }}" class="object-cover h-full rounded" src="{{ asset($service['image']) }}" title="{{ $service['name'] }}" />
                    </div>

                    <div class="w-full">
                        <h3 class="mb-4">{{ $service['name'] }}</h3>

                        <p class="mb-4 place-self-stretch text-justify">{{ \Illuminate\Support\Str::of($service['excerpt'])->words('50', '...') }}</p>

                        <a class="button-secondary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100"
                            href="{{ route(app()->getLocale() . '.services', ['locale' => app()->getLocale()]) . '/' . $service['slug'] }}">{{ __('Conozca más') }}...</a>
                    </div>
                </div>
                @empty 
                <div class="bg-neutral-100 flex gap-4 md:col-span-2 p-4 rounded">
                    <div class="h-32 w-52">
                        <img alt="Nina Code" class="object-cover h-full rounded" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="Nina Code" />
                    </div>

                    <div class="w-full">
                        <h3 class="mb-4">{{ __('Sin servicios') }}</h3>

                        <p class="mb-4">{{ __('No se encuentran servicios para mostrar') }}.</p>
                    </div>
                </div>
                @endforelse 
            </div>
        </div>
    </div>
</div>
