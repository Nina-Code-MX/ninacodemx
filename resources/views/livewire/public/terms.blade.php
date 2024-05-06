<div>
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h1>

            <h2 class="mb-4">{{ __('pages/terms.info_relevance.h2') }}</h4>
            @foreach (__('pages/terms.info_relevance.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/terms.non_autorized.h2') }}</h4>
            @foreach (__('pages/terms.non_autorized.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/terms.property.h2') }}</h4>
            @foreach (__('pages/terms.property.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/terms.warranty.h2') }}</h4>
            @foreach (__('pages/terms.warranty.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/terms.antifraud.h2') }}</h4>
            @foreach (__('pages/terms.antifraud.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <h2 class="mb-4">{{ __('pages/terms.privacy.h2') }}</h4>
            @foreach (__('pages/terms.privacy.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>
</div>

@push('meta') 
<meta name="description" content="{{ __('pages/terms.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/terms.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/terms.meta.description') }}" />
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
<meta property="twitter:description" content="{{ __('pages/terms.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush 
