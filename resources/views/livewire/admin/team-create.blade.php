<div>
    <x-admin.loading />

    <h1 class="border-b border-neutral-300 font-semibold px-2 py-4 text-lg">{{ __('Equípo') }} {{ __('Crear') }} <span class="font-normal">{{ __('Nuevo') }}</span></h1>

    <form wire:submit="save">
        <div class="gap-4 grid md:grid-cols-4 w-full">
            @error('generic') 
            <div class="bg-red-200 border border-red-700 md:col-span-4 p-2 rounded text-center w-full">
                <span class="text-red-700" id="errorId">{{ $message }}</span> 
            </div>
            @enderror 

            <x-admin.forms.input class="md:col-span-4 lg:col-span-4" id="team_form_id" :label="__('admin/team.id')" model="team_form.id" readonly="readonly" type="text" wire:model="team_form.id" />
            <x-admin.forms.input class="md:col-span-4 lg:col-span-4" id="team_form_full_name" :label="__('admin/team.full_name')" model="team_form.full_name" readonly="readonly" type="text" wire:model="team_form.full_name" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="team_form_first_name" :label="__('admin/team.first_name')" model="team_form.first_name" type="text" wire:model="team_form.first_name" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="team_form_last_name" :label="__('admin/team.last_name')" model="team_form.last_name" type="text" wire:model="team_form.last_name" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="team_form_title" :label="__('admin/team.title')" model="team_form.title" type="text" wire:model="team_form.title" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="team_form_order" :label="__('admin/team.order')" model="team_form.order" type="text" wire:model="team_form.order" />

            <div class="mb-10 md:col-span-4 w-full">
                <div class="flex gap-4 items-center justify-between md:justify-start w-full">
                    <div>
                        @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

                        @isset($team_form->image['key']) 
                            @if (\Storage::disk('s3')->exists($team_form->image['key'])) 
                                @php $image = \Storage::disk('s3')->url($team_form->image['key']); @endphp
                            @endif 
                        @endisset 

                        <img class="h-16 rounded-full" src="{{ $image }}" />
                    </div>

                    <div>
                        <label class="block pb-2" for="team_form_upload">{{ __('admin/team.image') }}</label>
                        <input class="h-10 px-2 rounded-sm w-full" type="file" id="team_form_upload" wire:model.live="team_form.image_upload" />
                        @error('team_form.image') <span class="error text-xs text-red-500" id="errorImage">{{ $message }}</span> @enderror
                        @error('team_form.image_upload') <span class="error text-xs text-red-500" id="errorImageUpload">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>

            <div class="md:col-span-4 flex gap-4 items-center justify-end w-full">
                <a class="bg-neutral-300 border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-400" href="{{ route('admin.team.listing') }}">{{ __('Cancelar') }}</a>
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>