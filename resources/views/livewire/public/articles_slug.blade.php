@php
    $lang_available = config('app.locale_available') ?? ['es' => 'Español'];
    $lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];
    $lang = \Cookie::get('lang') ?: config('app.locale') ?: 'es';
    $lang = in_array($lang, array_keys($lang_available)) ? $lang : 'es';
    app()->setLocale($lang);
@endphp 

@php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

@isset($articles['image']['key']) 
    @if (\Storage::disk('s3')->exists($articles['image']['key'])) 
        @php $image = \Storage::disk('s3')->url($articles['image']['key']); @endphp
    @endif 
@endisset 
<div data-section-id="Articles">
    
    <div class="bg-neutral-100 mb-4 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <div class="items-center gap-4 justify-between lg:flex">
                <div class="border border-neutral-300 h-40 lg:mb-0 lg:w-1/3 mb-4 rounded shadow">
                    <img alt="{{ $articles['title'] }}" class="object-cover object-center h-full rounded w-full" src="{{ $image }}" title="{{ $articles['title'] }}" />
                </div>

                <h1>{{ $articles['title'] }}</h1>
            </div>
        </div>
    </div>

    <div class="bg-neutral-50 container mx-auto rounded shadow">
        <div class="mx-auto px-4 py-10">
            <div class="container mx-auto">
                {!! $articles['content'] !!}

                <div class="flex items-center justify-end gap-4">
                    <a class="button-cancel border font-bold inline-block mb-2 mr-0 px-4 py-2 rounded text-center text-slate-100 w-auto"
                        href="{{ route(app()->getLocale() . '.articles', ['locale' => app()->getLocale()]) }}">{{ __('Volver') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    div[data-section-id="Articles"] p {
        margin-bottom: 1.5rem;
    }

    div[data-section-id="Articles"] ul {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    div[data-section-id="Articles"] ul li {
        background-color: rgba(110, 152, 50, 100);
        border: 1px solid #e5e7eb;
        border-radius: 0.25rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); 
        color: rgba(255, 255, 110, 100);
        cursor: default;
        display: block;
        font-weight: normal;
        padding: 0.5rem 1rem;
        width: 100%;
    }

    @media (min-width: 1024px) {
        div[data-section-id="Articles"] ul li {
            width: calc(50% - 1rem);
        }
    }
</style>
@endpush 

@push('meta')
<meta name="descripcion" content="{{ __('pages/articles.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/articles.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/articles.meta.description') }}" />
<meta property="og:image" content="{{ $image }}" />
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
<meta property="twitter:description" content="{{ __('pages/articles.meta.description') }}" />
<meta property="twitter:image" content="{{ $image }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush 