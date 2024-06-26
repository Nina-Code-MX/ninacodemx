@php
    $lang = app()->getLocale();
@endphp 
<div>
    <div class="mx-auto px-4 py-10">
        <div class="container mx-auto">
            <form action="{{ route($lang . '.pricing', ['locale' => $lang]) }}" method="POST" onsubmit="return window.submitQuote();">
                @csrf

                <x-shared.spinner />

                @if (session('success')) 
                <div class="bg-green-50 border border-green-500 flex font-semibold items-center mb-4 p-2 rounded shadow text-sm">
                    <div class="text-green-500 w-8"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg></div>
                    <div class="border-l border-green-500 px-2 w-full">{{ session('success') }}.</div>
                </div>
                @endif 

                @if ($submit_message) 
                <div class="bg-red-50 border border-red-500 flex font-semibold items-center mb-4 p-2 rounded shadow text-sm">
                    <div class="text-red-500 w-8"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg></div>
                    <div class="border-l border-red-500 px-2 w-full">{{ $submit_message }}.</div>
                </div>
                @endif 

                <div class="container-sm gap-4 grid grid-cols-1 items-start lg:grid-cols-2">
                    <x-shared.input-text class="col-span-1 lg:col-span-1" id="formDataFirstName" label="{{ __('Nombre(s)') }}*" name="formData.first_name" placeholder="{{ __('Nombre(s)') }}*" required="true" :selected="$formData['first_name']" />
                    <x-shared.input-text class="col-span-1 lg:col-span-1" id="formDataLastName" label="{{ __('Apellido(s)') }}*" name="formData.last_name" placeholder="{{ __('Apellido(s)') }}*" required="true" :selected="$formData['last_name']" />
                    <x-shared.input-text class="col-span-1 lg:col-span-2" id="formDataCompany" label="{{ __('Empresa') }}*" name="formData.company" placeholder="{{ __('Company') }}*" required="true" :selected="$formData['company']" />
                    <x-shared.input-text class="col-span-1 lg:col-span-1" id="formDataEmail" label="{{ __('Email') }}*" name="formData.email" placeholder="{{ __('Email') }}*" required="true" :selected="$formData['email']" />

                    <div class="col-span-1 lg:col-span-1" id="formDataPhoneContainer">
                        <label class="font-semibold sr-only">{{ __('Teléfono') }}</label>
                        <div wire:ignore>
                            <input class="border-gray-300 px-2 py-1 rounded w-full" id="formDataPhone" name="formDataPhone" placeholder="{{ __('Teléfono') }}*" required type="tel" value="{!! $formData['phone'] !!}" wire:defer="formData.phone" wire:key="formDataPhone" />
                        </div>
                        <span class="bold text-xs text-red-500">
                            @if($errors->has('formData.phone')){{ $errors->first('formData.phone') }}@endif 
                            @if($errors->has('formData.phoneCountry')){{ $errors->first('formData.phoneCountry') }}@endif 
                        </span>
                    </div>

                    <x-shared.text-area class="col-span-1 lg:col-span-2" id="formDataMessage" label="{{ __('Mensaje') }}*" name="formData.message" placeholder="{{ __('Mensaje') }}*" required="true" :selected="$formData['message']" rows="10" />
                    
                    <div class="col-span-1 flex items-center justify-end lg:col-span-2" id="formDataSubmitContainer">
                        <button class="button-primary border disabled:bg-gray-400 disabled:cursor-progress font-bold inline-block min-w-[100px] ml-auto mr-0 px-4 py-2 rounded text-center text-slate-100"
                            id="formDataSubmit"
                            wire:loading.attr="disabled"
                            wwwwire:click="formDataProcess">{{ __('pages/pricing.form.submit') }}</button>
                    </div>

                    <div class="col-span-1 lg:col-span-2">
                        <p class="italic text-sm text-justify">{{ __('Nota: Los campos marcados con un * son requeridos.') }}</p>
                        <p class="italic text-sm text-justify">{!! __('pages/pricing.form.info', ['privacy' => route($lang . '.privacy', ['locale' => $lang]), 'terms' => route($lang . '.terms', ['locale' => $lang])]) !!}</p>
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
    document.addEventListener('livewire:init', async () => {
        const userIp = await fetch('https://ipgeolocation.abstractapi.com/v1/?api_key=' + window.VITE_ABSTRACTAIP_API_KEY)
            .then(res => res.json());
        const input = document.querySelector("#formDataPhone");
        const iti = window.intlTelInput(input, {
            preferredCountries: ['mx', 'us', 'ca'],
        });

        let phoneCountry = '+52';
        let country = 'México';

        input.addEventListener("countrychange", () => {
            const countryData = iti.getSelectedCountryData();

            if (!countryData?.dialCode) {
                phoneCountry = '+52';
            } else {
                phoneCountry = '+' + countryData?.dialCode;
            }

            if (!countryData?.name) {
                country = 'México';
            } else {
                country = countryData?.name;
            }
        });

        input.addEventListener('change', (e) => {
            let phone = e.target.value.replace(/[^0-9]/g, '');
        });

        window.submitQuote = () => {
            grecaptcha.enterprise.ready(() => {
                grecaptcha.enterprise.execute(VITE_GOOGLE_RECAPTCHA_KEY, {action: 'subscribe'}).then(async function(token) {
                    const submit = document.querySelector('#formDataSubmit');
                    const nameContainer = document.querySelector('#formDataNameContainer');

                    let first_name = document.querySelector("#formDataFirstName").value;
                    let last_name = document.querySelector("#formDataLastName").value;
                    let company = document.querySelector("#formDataCompany").value;
                    let email = document.querySelector("#formDataEmail").value;
                    let phone = document.querySelector("#formDataPhone").value.replace(/[^0-9]/g, '');
                    let message = document.querySelector("#formDataMessage").value;

                    @this.set('formData', {
                        first_name: first_name,
                        last_name: last_name,
                        company: company,
                        email: email,
                        phone: phone,
                        phoneCountry: phoneCountry,
                        country: country,
                        message: message,
                        reCaptcha: token,
                        ip: userIp?.ip_address || '127.0.0.1'
                    });

                    @this.call('formDataProcess');
                });
            });

            return false;
        };
    });
</script>
@endpush 

@push('meta') 
<meta name="description" content="{{ __('pages/contact.meta.description') }}" />
<meta name="keywords" content="{{ __('pages/contact.meta.keywords') }}" />
<meta name="title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:title" content="{{ ($pageTitle ?? '') . ' - ' . env('APP_NAME', 'Laravel') }}" />
<meta property="og:description" content="{{ __('pages/contact.meta.description') }}" />
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
<meta property="twitter:description" content="{{ __('pages/contact.meta.description') }}" />
<meta property="twitter:image" content="{{ asset('images/logo-ninacode-mx-1024.png') }}" />
<meta property="twitter:image:alt" content="{{ env('APP_NAME', 'Laravel') }}" />
<meta property="twitter:card" content="summary_large_image" />
@endpush 
