@php
$lang = app()->getLocale();
@endphp
<div>
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                @forelse ($articles as $articles)
                @php $articles = $articles->toArray(); @endphp
                @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp

                @isset($articles['image']['key'])
                @if (\Storage::disk('s3')->exists($articles['image']['key']))
                @php $image = \Storage::disk('s3')->url($articles['image']['key']); @endphp
                @endif
                @endisset

                <div class="bg-neutral-100 lg:flex gap-4 p-4 place-self-stretch rounded">
                    <div class="h-32 mx-auto w-52">
                        <img alt="{{ $articles['title'] }}" class="object-cover h-full mx-auto rounded"
                            src="{{ $image }}" title="{{ $articles['title'] }}" />
                    </div>

                    <div class="w-full">
                        <h3 class="mb-4 lg:text-left text-center">{{ $articles['title'] }}</h3>

                        <p class="mb-4 place-self-stretch text-justify">{{
                            \Illuminate\Support\Str::of($articles['excerpt'])->words('50', '...') }}</p>

                        <div class="flex gap-4 items-center justify-end">
                            <a class="button-secondary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100"
                                href="{{ route(app()->getLocale() . '.articles', ['locale' => app()->getLocale()]) . '/' . \Carbon\Carbon::parse($articles["created_at"])
                                ->format("Y") . "/" . \Carbon\Carbon::parse($articles["created_at"])->format("m") . "/" . $articles['slug'] }}">{{ __('Conozca más') }}...</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-neutral-100 flex gap-4 md:col-span-2 p-4 rounded">
                    <div class="h-32 w-52">
                        <img alt="Nina Code" class="object-cover h-full rounded"
                            src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="Nina Code" />
                    </div>

                    <div class="w-full">
                        <h3 class="mb-4">{{ __('Sin articulos') }}</h3>

                        <p class="mb-4">{{ __('No se encuentran articulos para mostrar') }}.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('meta')
<meta name="description" content="{{ __('pages/articles.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/articles.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/articles.meta.description') }}" />
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
<meta property="twitter:description" content="{{ __('pages/articles.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush