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

            <div class="md:col-span-4 w-full">
                <label class="block pb-2" for="portfolio_form_id">{{ __('admin/portfolio.id') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="portfolio_form_id" readonly="readonly" wire:model="portfolio_form.id" />
                @error('portfolio_form.id') <span class="error text-xs text-red-500" id="errorId">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-2 w-full">
                <label class="block pb-2" for="portfolio_form_name">{{ __('admin/portfolio.name') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="portfolio_form_name" wire:model="portfolio_form.name" />
                @error('portfolio_form.name') <span class="error text-xs text-red-500" id="errortName">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="portfolio_form_url">{{ __('admin/portfolio.url') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="url" id="portfolio_form_url" wire:model="portfolio_form.url" />
                @error('portfolio_form.url') <span class="error text-xs text-red-500" id="errorUrl">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1 w-full">
                <label class="block pb-2" for="portfolio_form_project_date">{{ __('admin/portfolio.project_date') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="date" id="portfolio_form_project_date" wire:model="portfolio_form.project_date" />
                @error('portfolio_form.project_date') <span class="error text-xs text-red-500" id="errorProjectDate">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 lg:col-span-4 w-full">
                <label class="block pb-2" for="portfolio_form_description">{{ __('admin/portfolio.description') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="portfolio_form_description" wire:model="portfolio_form.description" />
                @error('portfolio_form.description') <span class="error text-xs text-red-500" id="errorDescription">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 lg:col-span-4 w-full">
                <label class="block pb-2" for="portfolio_form_tags">{{ __('admin/portfolio.tags') }}</label>
                <input class="h-10 px-2 rounded-sm w-full" type="text" id="portfolio_form_tags" wire:model="portfolio_form.tags" />
                @error('portfolio_form.tags') <span class="error text-xs text-red-500" id="errorTags">{{ $message }}</span> @enderror
            </div>

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

            <div class="md:col-span-4 flex items-center justify-end w-full">
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>