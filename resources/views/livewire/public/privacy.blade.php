<div>
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h1>

            <p class="mb-4 text-justify">{!! __('pages/privacy.date') !!}</p>

            <p class="mb-4 text-justify">{!! __('pages/privacy.intro') !!}</p>

            <h2 class="mb-4">{{ __('pages/privacy.info.h2') }}</h4>
            @foreach (__('pages/privacy.info.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/privacy.usage.h2') }}</h4>
            @foreach (__('pages/privacy.usage.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/privacy.cookies.h2') }}</h4>
            @foreach (__('pages/privacy.cookies.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/privacy.third_party.h2') }}</h4>
            @foreach (__('pages/privacy.third_party.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/privacy.personal.h2') }}</h4>
            @foreach (__('pages/privacy.personal.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>
</div>

@push('meta') 
<meta name="description" content="{{ __('pages/privacy.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/privacy.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/privacy.meta.description') }}" />
<meta property="og:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="{{ \Cookie::get('lang') ?: config('app.locale') }}" />
<meta property="og:site_name" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="1024" />
<meta property="twitter:card" content="summary" />
<meta property="twitter:site" content="@ninacodemx" />
<meta property="twitter:creator" content="@ninacodemx" />
<meta property="twitter:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:description" content="{{ __('pages/privacy.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush 
