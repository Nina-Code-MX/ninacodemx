<div>
    <div class="bg-neutral-100 mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h2>{{ __('pages/home.what_we_do.h2') }}</h2>
            <h3 class="mb-4">{{ __('pages/home.what_we_do.h3') }}</h3>

            @foreach (__('pages/home.what_we_do.p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 

            <hr class="mb-4 " />

            <h4 class="mb-4">{{ __('pages/home.commitment.h4') }}</h4>

            @foreach (__('pages/home.commitment.p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 
        </div>
    </div>

    <div class="px-4 py-10">
        <div class="container gap-6 grid grid-cols-1 mx-auto sm:grid-cols-2">
            @foreach ($services as $service) 
            <div class="bg-neutral-100 border border-neutral-300 gap-6 p-4 rounded-lg lg:flex">
                <div class="border border-neutral-300 h-40 lg:h-full lg:mb-0 lg:w-1/3 mb-4 rounded shadow">
                    <img alt="{{ $service['name'] }}" class="object-cover object-top h-full rounded w-full" src="{{ asset(\Storage::url($service['image'])) }}" title="{{ $service['name'] }}" />
                </div>

                <div class="lg:w-2/3">
                    <h3 class="mb-2 text-center lg:text-left">{{ $service['name'] }}</h3>

                    <p class="mb-4 text-justify">{{ $service['excerpt'] }}</p>
                </div>
            </div>
            @endforeach 
        </div>
    </div>

    <div class="bg-neutral-100 px-4 py-10">
        <div class="container mx-auto ">
            <h2>{{ __('pages/home.benefits.h2') }}</h2>
            <h3 class="mb-4">{{ __('pages/home.benefits.h3') }}</h3>

            <ol class="flex flex-wrap gap-6 items-center justify-between w-full">
                @foreach (__('pages/home.benefits.items') ?? [] as $item) 
                <li class="bg-fourth border cursor-pointer hover:bg-fourth px-4 py-1 rounded shadow text-neutral-100">{!! $item !!}</li>
                @endforeach 
            </ol>
        </div>
    </div>

    <div class="px-4 py-10">
        <div class="container mx-auto">
            <h2>{{ __('pages/home.our_team.h2') }}</h2>
            <h3 class="mb-4">{{ __('pages/home.our_team.h3') }}</h3>

            @foreach (__('pages/home.our_team.p') ?? [] AS $p) 
            <p class="mb-4">{!! $p !!}</p>
            @endforeach 

            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 max-w-6xl mx-auto place-items-center">
                @foreach ($teams as $team)
                <div class="bg-neutral-50 border p-4 place-self-stretch rounded">
                    <div class="flex flex-col gap-2 h-[100%]">
                        <div class="bg-neutral-100 border h-36 w-full mb-2 rounded">
                            <img alt="Desarrollo" class="object-cover h-full rounded w-full" src="{{ asset($team['image'] ?? 'images/logo-ninacode-mx-1024.png') }}" />
                        </div>
                        <h4 class="text-center">{{ $team['full_name'] }}</h4>
                        <p class="h-full place-self-stretch text-center text-sm">{{ $team['title'] }}</p>
                        <ul class="flex flex-row gap-4 items-center justify-center">
                            @foreach ($team['team_socials'] as $social) 
                            <li class="h-8 w-8"><a  class="h-8 w-8" href="{{ $social['link'] ?? '#' }}" target="_{{ $social['type'] ?? 'dog' }}"><i class="{{ $social['logo'] ?? 'fa-solid fa-dog' }} fa-lg"></i></a></li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
                @endforeach 

                <div class="bg-neutral-50 border p-4 place-self-stretch rounded">
                    <div class="flex flex-col gap-2 h-[100%]">
                        <div class="bg-neutral-100 border h-36 w-full mb-2 rounded">
                            <img alt="{{ __('pages/home.our_team.nina') }}" class="object-cover h-full rounded w-full" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="{{ __('pages/home.our_team.nina') }}" />
                        </div>
                        <h4 class="text-center">Nina</h4>
                        <p class="h-full place-self-stretch text-center text-sm">{{ __('pages/home.our_team.nina') }}</p>
                        <ul class="flex flex-row gap-4 items-center justify-center">
                        </ul>
                    </div>
                </div>

                <div class="bg-neutral-50 border p-4 place-self-stretch rounded">
                    <div class="flex flex-col gap-2 h-[100%]">
                        <div class="bg-neutral-100 border h-36 w-full mb-2 rounded">
                            <img alt="{{ __('pages/home.our_team.olivia') }}" class="object-cover h-full rounded w-full" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="{{ __('pages/home.our_team.olivia') }}" />
                        </div>
                        <h4 class="text-center">Olivia</h4>
                        <p class="h-full place-self-stretch text-center text-sm">{{ __('pages/home.our_team.olivia') }}</p>
                        <ul class="flex flex-row gap-4 items-center justify-center">
                        </ul>
                    </div>
                </div>

                <div class="bg-neutral-50 border p-4 place-self-stretch rounded">
                    <div class="flex flex-col gap-2 h-[100%]">
                        <div class="bg-neutral-100 border h-36 w-full mb-2 rounded">
                            <img alt="{{ __('pages/home.our_team.frank') }}" class="object-cover h-full rounded w-full" src="{{ asset('images/logo-ninacode-mx-1024.png') }}" title="{{ __('pages/home.our_team.frank') }}" />
                        </div>
                        <h4 class="text-center">Frank</h4>
                        <p class="h-full place-self-stretch text-center text-sm">{{ __('pages/home.our_team.frank') }}</p>
                        <ul class="flex flex-row gap-4 items-center justify-center">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-neutral-100 px-4 py-10">
        <div class="container mx-auto">
            <h2>{{ __('pages/home.learn_more.h2') }}</h2>
            <h3 class="mb-4">{{ __('pages/home.learn_more.h3') }}</h3>

            <div class="h-0 mb-4 overflow-hidden pb-[56.25%] pt-[30px] relative">
                <!-- h-[315px] max-h-[315px] max-w-[560px] mx-auto my-24 w-[560px] -->
                <iframe class="absolute h-full left-0 top-0 w-full" src="https://www.youtube.com/embed/7QrDGjDf8q0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>

            <div class="bg-primary p-8 rounded text-neutral-100">
                <div class="flex flex-col  gap-6 items-center justify-between lg:flex-row">
                    <div class="lg:w-1/2 text-center w-full">
                        <h4 class="text-neutral-100">{{ __('pages/home.newsletter.h4') }}</h4>
                        @foreach (__('pages/home.newsletter.p') ?? [] AS $p) 
                        <p>{!! $p !!}</p>
                        @endforeach 
                    </div>

                    <div class="lg:w-1/2 w-full">
                        <form action="#" method="post" onsubmit="return registerNewsletter();">
                            <div class="flex flex-row">
                                <div class="w-full"><input class="border px-2 py-1 text-gray-800 w-full" id="newsltter-email" placeholder="Correo electrónico *" type="email" /></div>
                                <div class="w-auto"><button class="bg-fourth border disabled:bg-gray-800 disabled:text-gray-100 hover:bg-fourth px-2 py-1 w-auto" id="newsltter-submit" type="submit">{{ __('pages/home.newsletter.label') }}</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-10">
        <div class="container mx-auto text-center">
            <h2 class="mb-4">{{ __('pages/home.contact.h2') }}</h2>
            <a class="button-primary border font-bold inline-block mb-2 ml-auto mr-0 px-4 py-2 rounded text-slate-100" href="{{ route((\Cookie::get('lang') ?: config('app.locale') ?: 'es') . '.contact', ['locale' => \Cookie::get('lang') ?: config('app.locale') ?: 'es']) }}">{{ __('pages/home.contact.label') }}</a>
        </div>
    </div>

    <div class="px-4 py-10">
        <div id="map"></div>
    </div>
</div>

@push('styles')
<style>
#map {
    height: 520px;
    width: 100%;
}
</style>
@endpush 

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY', '') }}" defer></script>
@vite('resources/js/public/index.js') 
@endpush 