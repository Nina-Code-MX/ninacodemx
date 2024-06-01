<div>
    <x-admin.loading />

    <h1 class="border-b border-neutral-300 font-semibold px-2 py-4 text-lg">{{ __('Editar') }} <span class="font-normal">({{ $portfolio_form->id ?? '0' }}) {{ $portfolio_form->name ?? 'Unknown' }}</span></h1>

    <form wire:submit="save">
        <div class="gap-4 grid md:grid-cols-4 w-full">
            @error('generic') 
            <div class="bg-red-200 border border-red-700 md:col-span-4 p-2 rounded text-center w-full">
                <span class="text-red-700" id="errorId">{{ $message }}</span> 
            </div>
            @enderror 

            <x-admin.forms.input class="md:col-span-4 lg:col-span-4" id="portfolio_form_id" :label="__('admin/portfolio.id')" model="portfolio_form.id" readonly="readonly" type="text" wire:model="portfolio_form.id" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-2" id="portfolio_form_id" :label="__('admin/portfolio.name')" model="portfolio_form.name" type="text" wire:model="portfolio_form.name" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-2" id="portfolio_form_url" :label="__('admin/portfolio.url')" model="portfolio_form.url" type="url" wire:model="portfolio_form.url" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-2" id="portfolio_form_project_date" :label="__('admin/portfolio.project_date')" model="portfolio_form.project_date" type="date" wire:model="portfolio_form.project_date" />
            <x-admin.forms.textarea class="md:col-span-2 lg:col-span-2" id="portfolio_form_project_description" :label="__('admin/portfolio.description')" model="portfolio_form.description" rows="10" wire:model="portfolio_form.description" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-2" id="portfolio_form_tags" :label="__('admin/portfolio.tags')" model="portfolio_form.tags" type="text" wire:model="portfolio_form.tags" />

            {{--
            <div class="md:col-span-4 w-full">
                <div class="md:flex md:gap-4 md:items-center w-full">
                    <div>
                        @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

                        @isset($portfolio_form->image['key']) 
                            @if (\Storage::disk('s3')->exists($portfolio_form->image['key'])) 
                                @php $image = \Storage::disk('s3')->url($portfolio_form->image['key']); @endphp
                            @endif 
                        @endisset 

                        <img class="h-16 rounded-full" src="{{ $image }}" />
                    </div>

                    <div>
                        <label class="block pb-2" for="portfolio_form_upload">{{ __('admin/portfolio.image') }}</label>
                        <input class="h-10 px-2 rounded-sm w-full" type="file" id="portfolio_form_upload" wire:model.live="portfolio_form.image_upload" />
                        @error('portfolio_form.image') <span class="error text-xs text-red-500" id="errorImage">{{ $message }}</span> @enderror
                        @error('portfolio_form.image_upload') <span class="error text-xs text-red-500" id="errorImageUpload">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
            --}}

            <div class="md:col-span-4 flex gap-4 items-center justify-end w-full">
                <a class="bg-neutral-300 border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-400" href="{{ route('admin.portfolio.listing') }}">{{ __('Cancelar') }}</a>
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>