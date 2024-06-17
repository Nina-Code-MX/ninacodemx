@php
    $lang_available = config('app.locale_available') ?? ['es' => 'Español'];
    $lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];
    $lang = \Cookie::get('lang') ?: config('app.locale') ?: 'es';
    $lang = in_array($lang, array_keys($lang_available)) ? $lang : 'es';
    app()->setLocale($lang);
@endphp 
<div>
    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h2>
        </div>
    </div>

    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h3 class="mb-4">{{ __('pages/aboutus.history') }}</h3>

            @foreach (__('pages/aboutus.history_p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>

    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h2 class="mb-4">{{ __('pages/aboutus.mission_vision_values') }}</h2>
        </div>
    </div>

    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h3 class="mb-4">{{ __('pages/aboutus.mission') }}</h3>

            @foreach (__('pages/aboutus.mission_p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 

            <h3 class="mb-4">{{ __('pages/aboutus.vision') }}</h3>

            @foreach (__('pages/aboutus.vision_p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 

            <h3 class="mb-4">{{ __('pages/aboutus.values.h3') }}</h3>

            <ul class="mb-4">
                @foreach (__('pages/aboutus.values.items') ?? [] AS $i) 
                <li>&gt; {!! $i !!}</li>
                @endforeach 
            </ul>
        </div>
    </div>
</div>

@push('meta') 
<meta name="description" content="{{ __('pages/aboutus.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/aboutus.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/aboutus.meta.description') }}" />
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
<meta property="twitter:description" content="{{ __('pages/aboutus.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush 
