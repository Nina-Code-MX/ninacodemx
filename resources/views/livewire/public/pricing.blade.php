<div>
    @php $lang = \Cookie::get('lang') ?: config('app.locale'); @endphp 
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <h1 class="mb-4">{{ $pageTitle ?? '' }}</h1>

            <h2 class="mb-4">{{ __('pages/pricing.h2') }}</h2>

            @foreach (__('pages/pricing.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <form action="{{ route($lang . '.pricing', ['locale' => $lang]) }}" method="POST" onsubmit="return submitQuote();">
                <h3 class="mb-4">{{ __('pages/pricing.form.title') }}</h3>

                @if($errors->has('formData.reCaptcha'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.reCaptcha') }}</span>@endif 
                <pre>{{ print_r($formData, true) }}</pre>

                <x-shared.spinner />

                <div class="container-sm gap-4 grid grid-cols-1 items-start lg:grid-cols-2">
                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Nombre(s)') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataName" name="formDataName" placeholder="{{ __('Nombre(s)') }}*" type="text" wire:defer="formData.name" />
                        @if($errors->has('formData.name'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.name') }}</span>@endif 
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Apellido(s)') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataLastname" name="formDataLastname" placeholder="{{ __('Apellido(s)') }}*" type="text" wire:defer="formData.lastname" />
                        @if($errors->has('formData.lastname'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.lastname') }}</span>@endif 
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('Company') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataCompany" name="formDataCompany" placeholder="{{ __('Company') }}*" type="text" wire:defer="formData.company" />
                        @if($errors->has('formData.company'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.company') }}</span>@endif 
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Email') }}</label>
                        <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataEmail" name="formDataEmail" placeholder="{{ __('Email') }}*" type="text" wire:defer="formData.email" />
                        @if($errors->has('formData.email'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.email') }}</span>@endif 
                    </div>

                    <div class="">
                        <label class="font-semibold sr-only">{{ __('Teléfono') }}</label>
                        <div wire:ignore>
                            <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataPhone" name="formDataPhone" placeholder="{{ __('Teléfono') }}*" type="tel" wire:defer="formData.phone" wire:key="formDataPhone" />
                        </div>
                        @if($errors->has('formData.phone'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.phone') }}</span>@endif 
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('mainmenu.services') }}</label>
                        <select class="border-gray-300 px-2 py-1 rounded w-full" id="formDataService" name="formDataService" wire:defer="formData.service">
                            <option value="">== {{ __('Seleccione un servicio') }}</option>
                            @foreach ($services AS $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach 
                        </select>
                        @if($errors->has('formData.service'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.service') }}</span>@endif 
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold sr-only">{{ __('Company') }}</label>
                        <textarea class="border-gray-300 px-2 py-1 rounded w-full" id="formDataMessage" name="formDataMessage" placeholder="{{ __('Mensaje') }}*" rows="10" wire:defer="formData.message"></textarea>
                        @if($errors->has('formData.message'))<span class="bold pl-4 text-xs text-red-500">{{ $errors->first('formData.message') }}</span>@endif 
                    </div>
                    
                    <div class="flex items-center justify-end lg:col-span-2">
                        <button class="button-primary border disabled:bg-gray-400 disabled:cursor-progress font-bold inline-block min-w-[100px] ml-auto mr-0 px-4 py-2 rounded text-center text-slate-100" wire:loading.attr="disabled" wire:click="formDataProcess">{{ __('pages/pricing.form.submit') }}</button>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="italic text-xs text-justify">{!! __('pages/pricing.form.info', ['privacy' => route($lang . '.privacy', ['locale' => $lang]), 'terms' => route($lang . '.terms', ['locale' => $lang])]) !!}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
@vite('resources/js/public/pricing.js') 
<script wire:ignore>
    document.addEventListener('livewire:load', () => {
        function submitQuote() {
	        grecaptcha.enterprise.ready(() => {
		        grecaptcha.enterprise.execute(VITE_GOOGLE_RECAPTCHA_KEY, {action: 'subscribe'}).then(async function(token) {
                    let name = document.querySelector("#formDataName").value;
                    let lastname = document.querySelector("#formDataLastname").value;
                    let company = document.querySelector("#formDataCompany").value;
                    let email = document.querySelector("#formDataEmail").value;
                    let phone = document.querySelector("#formDataPhone").value;
                    let service = document.querySelector("#formDataService").value;
                    let message = document.querySelector("#formDataMessage").value;

                    @this.set('formData.reCaptcha', token);
                    @this.set('formData.name', name);
                    @this.set('formData.lastname', lastname);
                    @this.set('formData.company', company);
                    @this.set('formData.email', email);
                    @this.set('formData.phone', phone);
                    @this.set('formData.service', service);
                    @this.set('formData.message', message);
		        });
	        });

            return false;
        };

        const input = document.querySelector("#formDataPhone");
        const iti = window.intlTelInput(input, {
            preferredCountries: ['mx', 'us', 'ca'],
        });

        @this.set('formData.phoneCountry', '+52');

        input.addEventListener("countrychange", () => {
            let dialCode = iti.getSelectedCountryData()?.dialCode;
            let phone = iti.getNumber();

            if (!dialCode) {
                dialCode = '+52';
            } else {
                dialCode = '+' + dialCode;
            }

            @this.set('formData.phoneCountry', dialCode);
        });


        input.addEventListener('change', (e) => {
            let phone = e.target.value.replace(/[^0-9]/g, '');
            @this.set('formData.phone', phone);
        });
    });
</script>
@endpush 