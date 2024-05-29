<div>
    <h1 class="border-b border-neutral-300 font-semibold mb-4 px-2 py-4 text-lg">{{ __('Contacto') }}</h1>

    <x-table :data="$contact" :headers="\App\Models\ContactForm::$headers" />
</div>
