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
