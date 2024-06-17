@php
    $lang_available = config('app.locale_available') ?? ['es' => 'Español'];
    $lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];
    $lang = \Cookie::get('lang') ?: config('app.locale') ?: 'es';
    $lang = in_array($lang, array_keys($lang_available)) ? $lang : 'es';
@endphp 
<div>
    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h1>

            @foreach (__('pages/portfolio.p') ?? [] AS $p) 
                <p class="mb-4">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>

    <div class="px-4 py-10">
        <div class="container gap-6 grid grid-cols-1 mx-auto lg:grid-cols-2">
            @forelse ($portfolios as $portfolio) 
                @php $portfolio = $portfolio->append('project_date_human')->toArray(); @endphp
                <div class="bg-neutral-100 flex gap-4 p-4 rounded">
                    <div class="h-32 w-52">
                        <img alt="Lim Media" class="object-cover h-full rounded" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
                    </div>
                    <div class="w-full">
                        <h2 class="mb-4">{{ $portfolio['name'] }}</h2>

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

@push('meta')
<meta name="description" content="{{ __('pages/portfolio.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/portfolio.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/portfolio.meta.description') }}" />
<meta property="og:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="{{ $lang }}" />
<meta property="og:site_name" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="1024" />
<meta property="twitter:card" content="summary" />
<meta property="twitter:site" content="@ninacodemx" />
<meta property="twitter:creator" content="@ninacodemx" />
<meta property="twitter:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:description" content="{{ __('pages/portfolio.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush