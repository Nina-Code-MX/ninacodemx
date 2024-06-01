<div>
    <x-admin.loading />

    <h1 class="border-b border-neutral-300 font-semibold px-2 py-4 text-lg">{{ __('Editar') }} <span class="font-normal">({{ $service_form->id ?? '0' }}) {{ $service_form->name ?? 'Unknown' }}</span></h1>

    <form wire:submit="save">
        <div class="gap-4 grid md:grid-cols-4 w-full">
            @error('generic') 
            <div class="bg-red-200 border border-red-700 md:col-span-4 p-2 rounded text-center w-full">
                <span class="text-red-700" id="errorId">{{ $message }}</span> 
            </div>
            @enderror 

            <div class="md:col-span-4 lg:col-span-4 w-full">
                <label class="block pb-2" for="service_form_id">{{ __('admin/service.id') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="service_form_id" readonly="readonly" wire:model="service_form.id" />
                @error('service_form.id') <span class="error text-xs text-red-500" id="errorId">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="service_form_name">{{ __('admin/service.name') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="service_form_name" wire:model="service_form.name" />
                @error('service_form.name') <span class="error text-xs text-red-500" id="errorName">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="service_form_excerpt">{{ __('admin/service.excerpt') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="service_form_excerpt" wire:model="service_form.excerpt" />
                @error('service_form.excerpt') <span class="error text-xs text-red-500" id="errorExcerpt">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="service_form_slug">{{ __('admin/service.slug') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="service_form_slug" wire:model="service_form.slug" />
                @error('service_form.slug') <span class="error text-xs text-red-500" id="errorSlug">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="service_form_order">{{ __('admin/service.order') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="number" id="service_form_order" wire:model="service_form.order" />
                @error('service_form.order') <span class="error text-xs text-red-500" id="errorOrder">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 lg:col-span-4 w-full">
                <label class="block pb-2" for="service_form_description">{{ __('admin/service.description') }}</label>
                <textarea class="px-2 rounded-sm w-full" id="service_form_description" rows="5" wire:model="service_form.description"></textarea>
                @error('service_form.description') <span class="error text-xs text-red-500" id="errorDescription">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 lg:col-span-4 w-full">
                <div class="md:flex md:gap-4 md:items-center w-full">
                    <div>
                        @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

                        @isset($service_form->image['key']) 
                            @if (\Storage::disk('s3')->exists($service_form->image['key'])) 
                                @php $image = \Storage::disk('s3')->url($service_form->image['key']); @endphp
                            @endif 
                        @endisset 

                        <img class="h-16 rounded-full" src="{{ $image }}" />
                    </div>

                    <div>
                        <label class="block pb-2" for="service_form_upload">{{ __('admin/service.image') }}</label>
                        <input class="h-10 px-2 rounded-sm w-full" type="file" id="service_form_upload" wire:model.live="service_form.image_upload" />
                        @error('service_form.image') <span class="error text-xs text-red-500" id="errorImage">{{ $message }}</span> @enderror
                        @error('service_form.image_upload') <span class="error text-xs text-red-500" id="errorImageUpload">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>

            <div class="md:col-span-4 flex items-center justify-end lg:col-span-4 w-full">
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>
