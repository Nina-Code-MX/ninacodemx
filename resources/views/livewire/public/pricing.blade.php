<div>
    @php $lang = \Cookie::get('lang') ?: config('app.locale'); @endphp 
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            @foreach (__('pages/pricing.p') ?? [] AS $p) 
            <p class="mb-4 text-justify">{!! $p !!}</p>
            @endforeach 

            <form action="{{ route($lang . '.pricing', ['locale' => $lang]) }}" method="POST" onsubmit="return window.submitQuote();">
                <h3 class="mb-4">{{ __('pages/pricing.form.title') }}</h3>

                <x-shared.spinner />

                @if ($submit_message) 
                <p class="p-4 w-full">{{ $submit_message }}</p>
                @endif 

                <div class="container-sm gap-4 grid grid-cols-1 items-start lg:grid-cols-2">
                    <x-shared.input-text id="formDataName" label="{{ __('Nombre(s)') }}*" name="formData.name" placeholder="{{ __('Nombre(s)') }}*" required="true" />
                    <x-shared.input-text id="formDataLastname" label="{{ __('Apellido(s)') }}*" name="formData.lastname" placeholder="{{ __('Apellido(s)') }}*" required="true" />
                    <x-shared.input-text class="col-span-2" id="formDataCompany" label="{{ __('Empresa') }}*" name="formData.company" placeholder="{{ __('Company') }}" required="true" />
                    <x-shared.input-text id="formDataEmail" label="{{ __('Email') }}*" name="formData.email" placeholder="{{ __('Email') }}*" required="true" />

                    <div class="" id="formDataPhoneContainer">
                        <label class="font-semibold sr-only">{{ __('Teléfono') }}</label>
                        <div wire:ignore>
                            <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataPhone" name="formDataPhone" placeholder="{{ __('Teléfono') }}*" required type="tel" wire:defer="formData.phone" wire:key="formDataPhone" />
                        </div>
                        <span class="bold text-xs text-red-500">
                            @if($errors->has('formData.phone')){{ $errors->first('formData.phone') }}@endif 
                            @if($errors->has('formData.phoneCountry')){{ $errors->first('formData.phoneCountry') }}@endif 
                        </span>
                    </div>

                    <x-shared.select class="lg:col-span-2" :data="$services->map(fn($d) => ['id' => $d['id'], 'value' => $d['name']])->toArray()" id="formDataService" label="{{ __('mainmenu.services') }}" name="formData.message" placeholder="{{ __('Seleccione un servicio') }}" required="true" />
                    <x-shared.text-area class="lg:col-span-2" id="formDataMessage" label="{{ __('Mensaje') }}" name="formData.message" placeholder="{{ __('Mensaje') }}" rows="10" />
                    
                    <div class="flex items-center justify-end lg:col-span-2" id="formDataSubmitContainer">
                        <button class="button-primary border disabled:bg-gray-400 disabled:cursor-progress font-bold inline-block min-w-[100px] ml-auto mr-0 px-4 py-2 rounded text-center text-slate-100"
                            id="formDataSubmit"
                            wire:loading.attr="disabled"
                            wwwwire:click="formDataProcess">{{ __('pages/pricing.form.submit') }}</button>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="italic text-xs text-justify">{!! __('pages/pricing.form.info', ['privacy' => route($lang . '.privacy', ['locale' => $lang]), 'terms' => route($lang . '.terms', ['locale' => $lang])]) !!}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .iti { width: 100%; }
</style>
@endpush 
@push('scripts')
@vite('resources/js/public/pricing.js') 
<script>
    document.addEventListener('livewire:load', () => {
        const input = document.querySelector("#formDataPhone");
        const iti = window.intlTelInput(input, {
            preferredCountries: ['mx', 'us', 'ca'],
        });

        let phoneCountry = '+52';

        @this.set('formData.phoneCountry', '+52');

        input.addEventListener("countrychange", () => {
            let dialCode = iti.getSelectedCountryData()?.dialCode;

            if (!dialCode) {
                dialCode = '+52';
            } else {
                dialCode = '+' + dialCode;
            }

            phoneCountry = dialCode;

            // @this.set('formData.phoneCountry', dialCode);
        });


        input.addEventListener('change', (e) => {
            let phone = e.target.value.replace(/[^0-9]/g, '');
            // @this.set('formData.phone', phone);
        });

        window.submitQuote = () => {
            grecaptcha.enterprise.ready(() => {
                grecaptcha.enterprise.execute(VITE_GOOGLE_RECAPTCHA_KEY, {action: 'subscribe'}).then(async function(token) {
                    const submit = document.querySelector('#formDataSubmit');
                    const nameContainer = document.querySelector('#formDataNameContainer');

                    let name = document.querySelector("#formDataName").value;
                    let lastname = document.querySelector("#formDataLastname").value;
                    let company = document.querySelector("#formDataCompany").value;
                    let email = document.querySelector("#formDataEmail").value;
                    let phone = document.querySelector("#formDataPhone").value.replace(/[^0-9]/g, '');
                    let service = document.querySelector("#formDataService").value;
                    let message = document.querySelector("#formDataMessage").value;

                    @this.set('formData', {
                        name: name,
                        lastname: lastname,
                        company: company,
                        email: email,
                        phone: phone,
                        phoneCountry: phoneCountry,
                        service: service,
                        message: message,
                        reCaptcha: token
                    });

                    @this.call('formDataProcess');
                });
            });

            return false;
        };
    });
</script>
@endpush 