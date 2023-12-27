<div>
    @php $lang = \Cookie::get('lang') ?: config('app.locale'); @endphp 
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h1>

            <h2 class="mb-4">{{ __('pages/pricing.h2') }}</h2>

            @foreach (__('pages/pricing.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <form action="{{ route($lang . '.pricing', ['locale' => $lang]) }}" method="post" onsubmit="return false;">
                <h3 class="mb-4">{{ __('pages/pricing.form.title') }}</h3>

                <div class="container-sm gap-4 grid grid-cols-1 items-center lg:grid-cols-2">
                    <div class="lg:col-span-2 text-center">
                        <p>{{ $submit_message }}</p>
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Nombre(s)') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataName" name="formDataName" placeholder="{{ __('Nombre(s)') }}*" type="text" wire:defer="formData.name" />
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Apellido(s)') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataLastname" name="formDataLastname" placeholder="{{ __('Apellido(s)') }}*" type="text" wire:defer="formData.lastname" />
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('Company') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataCompany" name="formDataCompany" placeholder="{{ __('Company') }}*" type="text" wire:defer="formData.company" />
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Email') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataEmail" name="formDataEmail" placeholder="{{ __('Email') }}*" type="text" wire:defer="formData.email" />
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Teléfono') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataPhone" name="formDataPhone" placeholder="{{ __('Teléfono') }}*" type="text" wire:defer="formData.phone" />
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('mainmenu.services') }}</label>
                        <select class="border-gray-300 px-2 py-1 rounded w-full" id="formDataService" name="formDataService" wire:defer="formData.service">
                            <option value="">== {{ __('Seleccione un servicio') }}</option>
                            @foreach ($services AS $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach 
                        </select>
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('Company') }}</label>
                        <textarea class="border-gray-300 px-2 py-1 rounded w-full" id="formDataMessage" name="formDataMessage" placeholder="{{ __('Mensaje') }}*" rows="10" wire:defer="formData.message"></textarea>
                    </div>
                    
                    <div class="flex items-center justify-end lg:col-span-2">
                        <a class="button-primary border font-bold inline-block min-w-[100px] ml-auto mr-0 px-4 py-2 rounded text-center text-slate-100" href="#" wire:click="formDataProcess">{{ __('pages/pricing.form.submit') }}</a>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="italic text-xs text-justify">{!! __('pages/pricing.form.info', ['privacy' => route($lang . '.privacy', ['locale' => $lang]), 'terms' => route($lang . '.terms', ['locale' => $lang])]) !!}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
