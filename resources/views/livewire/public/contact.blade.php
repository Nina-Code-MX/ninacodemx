<div>
    <div class="container max-w-6xl mx-auto p-4">
        <form action="#" method="post" onsubmit="return false;">
            @csrf
            <input id="g-recaptcha" name="g-recaptcha" type="hidden" value="" wire:model.defer="contact.recaptcha">
            <input id="u-ip" name="u-ip" type="hidden" value="" wire:model.defer="contact.ip">

            <div class="gap-4 grid grid-cols-1 md:grid-cols-6">
                <div class="md:col-span-2">
                    <label class="block font-medium mb-2 w-full" for="first_name">{{ __('Nombre(s)') }}:</label>
                    <input class="rounded w-full" name="first_name" placeholder="{{ __('Juan') }}" type="text" wire:model.defer="contact.first_name">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-medium mb-2 w-full" for="last_name">{{ __('Apellido(s)') }}:</label>
                    <input class="rounded w-full" name="last_name" placeholder="{{ __('Perez') }}" type="text" wire:model.defer="contact.last_name">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-medium mb-2 w-full" for="company">{{ __('Empresa') }}:</label>
                    <input class="rounded w-full" name="company" placeholder="{{ __('Mi empresa') }}" type="text" wire:model.defer="contact.company">
                </div>

                <div class="md:col-span-3">
                    <label class="block font-medium mb-2 w-full" for="phone">{{ __('Teléfono') }}:</label>
                    <input class="rounded w-full" name="phone" placeholder="{{ __('+523339025911') }}" type="tel" wire:model.defer="contact.phone">
                </div>

                <div class="md:col-span-3">
                    <label class="block font-medium mb-2 w-full" for="phone">{{ __('Correo electrónico') }}:</label>
                    <input class="rounded w-full" name="email" placeholder="{{ __('juan@perez.com') }}" type="email" wire:model.defer="contact.email">
                </div>

                <div class="md:col-span-6">
                    <label class="block font-medium mb-2 w-full" for="phone">{{ __('Mensaje') }}:</label>
                    <textarea class="rounded w-full" name="message" placeholder="{{ __('Dejanos tu mensaje...') }}" rows="10" wire:model.defer="contact.message"></textarea>
                </div>

                <div class="flex items-center justify-end md:col-span-6">
                    <button class="bg-primary border hover:bg-primary ring rounded px-4 py-2 text-white" type="submit" wire:click="saveContact">{{ __('Enviar') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts') 
@vite('resources/js/public/contact.js') 
@endpush 
