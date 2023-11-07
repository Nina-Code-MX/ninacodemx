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
