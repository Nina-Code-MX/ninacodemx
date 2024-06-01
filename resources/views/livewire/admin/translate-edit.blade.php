<div>
    <x-admin.loading />

    <h1 class="border-b border-neutral-300 font-semibold px-2 py-4 text-lg">{{ __('Editar') }} <span class="font-normal">({{ $translate_form->id ?? '0' }}) {{ $translate_form->model_id ?? 'Unknown' }} {{ $translate_form->model_name ?? 'Unknown' }}</span></h1>

    <form class="mt-4" wire:submit="save">
        <div class="gap-4 grid md:grid-cols-4 w-full">
            @error('generic') 
            <div class="bg-red-200 border border-red-700 md:col-span-4 p-2 rounded text-center w-full">
                <span class="text-red-700" id="errorId">{{ $message }}</span> 
            </div>
            @enderror 

            <x-admin.forms.input class="md:col-span-4 lg:col-span-4" id="translate_form_id" :label="__('admin/service.id')" model="translate_form.id" readonly="readonly" type="text" wire:model="translate_form.id" />
            <x-admin.forms.select class="" :data="$models" id="translate_form_model_name" :label="__('admin/translate.model_name')" model="translate_form.model_name" wire:model.live="translate_form.model_name" />
            <x-admin.forms.select class="" :data="$model_data" id="translate_form_model_id" :label="__('admin/translate.model_id')" model="translate_form.model_id" wire:model.live="translate_form.model_id" />
            <x-admin.forms.input class="" id="translate_form_lang" :label="__('admin/translate.lang')" model="translate_form.lang" type="text" wire:model="translate_form.lang" />
            <x-admin.forms.textarea class="md:col-span-4 lg:col-span-4" id="translate_form_value" :label="__('admin/translate.value')" model="translate_form.value" rows="10" wire:model="translate_form.value" />

            <div class="md:col-span-4 flex gap-4 items-center justify-end lg:col-span-4 w-full">
                <a class="bg-neutral-300 border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-400" href="{{ route('admin.translate.listing') }}">{{ __('Cancelar') }}</a>
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>