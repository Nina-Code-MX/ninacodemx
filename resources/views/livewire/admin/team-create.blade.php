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

            <div class="md:col-span-2 w-full">
                <label class="block pb-2" for="team_form_id">{{ __('admin/team.id') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="team_form_id" readonly="readonly" wire:model="team_form.id" />
                @error('team_form.id') <span class="error text-xs text-red-500" id="errorId">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 w-full">
                <label class="block pb-2" for="team_form_full_name">{{ __('admin/team.full_name') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="team_form_full_name" readonly="readonly" wire:model="team_form.full_name" />
                @error('team_form.full_name') <span class="error text-xs text-red-500" id="errorFullName">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="team_form_first_name">{{ __('admin/team.first_name') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="team_form_first_name" wire:model="team_form.first_name" />
                @error('team_form.first_name') <span class="error text-xs text-red-500" id="errorFirstName">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="team_form_last_name">{{ __('admin/team.last_name') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="team_form_last_name" wire:model="team_form.last_name" />
                @error('team_form.last_name') <span class="error text-xs text-red-500" id="errorLastName">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="team_form_title">{{ __('admin/team.title') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="team_form_title" wire:model="team_form.title" />
                @error('team_form.title') <span class="error text-xs text-red-500" id="errorTitle">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="team_form_order">{{ __('admin/team.order') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="number" id="team_form_order" wire:model="team_form.order" />
                @error('team_form.order') <span class="error text-xs text-red-500" id="errorOrder">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 w-full">
                <div class="md:flex md:gap-4 md:items-center w-full">
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

            <div class="md:col-span-4 flex items-center justify-end w-full">
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>