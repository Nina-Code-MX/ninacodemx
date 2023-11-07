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
