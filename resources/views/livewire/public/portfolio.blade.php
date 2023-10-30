<div>
    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h2 class="mb-4">{{ $pageTitle ?? '' }}</h2>

            @foreach (__('pages/portfolio.p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>

    <div class="px-4 py-10">
        <div class="container gap-6 grid grid-cols-1 mx-auto lg:grid-cols-2">
            @forelse ($portfolios as $portfolio)
            <div class="bg-neutral-100 flex gap-4 p-4 rounded">
                <div class="h-32 w-52">
                    <img alt="Lim Media" class="object-cover h-full rounded" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
                </div>
                <div class="w-full">
                    <h3 class="mb-4">{{ $portfolio['name'] }}</h3>

                    <p class="mb-4">{{ $portfolio['description'] }}</p>

                    <ul class="mb-4">
                        <li class="mb-2"><strong>{{ __('Sitio web') }}:</strong> <a class="text-secondary" href="{{ $portfolio['url'] }}" target="_portfolio">{{ $portfolio['url'] }}</a></li>
                        <li class="mb-2"><strong>{{ __('Fecha') }}:</strong> <span>{{ $portfolio['project_date_human'] }}</span></li>
                        <li class="mb-2">
                            <div class="flex gap-2">
                                <strong class="border border-transparent py-1">{{ __('Tipo') }}:</strong> 
                                <ul class="flex flex-wrap gap-2">
                                    @foreach ($portfolio['tags'] as $tag) 
                                    <li class="bg-neutral-50 border cursor-default px-2 py-1 rounded-xl shadow">{{ $tag }}</li>
                                    @endforeach 
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @empty 
            @endforelse 
        </div>
    </div>
</div>
