<div>  
    <x-admin.loading />

    <h1 class="border-b border-neutral-300 font-semibold px-2 py-4 text-lg">{{ __('Articulo') }} {{ __('Crear') }} <span class="font-normal">{{ __('Nuevo') }}</span></h1>

    <form wire:submit="save">
        <div class="gap-4 grid md:grid-cols-4 w-full">
            @error('generic') 
            <div class="bg-red-200 border border-red-700 md:col-span-4 p-2 rounded text-center w-full">
                <span class="text-red-700" id="errorId">{{ $message }}</span> 
            </div>
            @enderror 

            <x-admin.forms.input class="md:col-span-4 lg:col-span-4" id="article_form_id" :label="__('admin/article.id')" model="article_form.id" readonly="readonly" type="text" wire:model="article_form.id" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="article_form_name" :label="__('admin/article.name')" model="article_form.name" type="text" wire:model="article_form.name" />
            <x-admin.forms.input class="md:col-span-2 lg:col-span-1" id="article_form_slug" :label="__('admin/article.slug')" model="article_form.slug" type="text" wire:model="article_form.slug" />
            <x-admin.forms.textarea class="md:col-span-4 lg:col-span-4" id="article_form_excerpt" :label="__('admin/article.excerpt')" model="article_form.excerpt" rows="10" wire:model="article_form.excerpt" />
            <x-admin.forms.textarea class="md:col-span-4 lg:col-span-4" id="article_form_content" :label="__('admin/article.content')" model="article_form.content" rows="10" wire:model="article_form.content" />
           

            <div class="mb-10 md:col-span-4 lg:col-span-4 w-full">
                <div class="flex gap-4 items-center justify-between md:justify-start w-full">
                    <div>
                        @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

                        @isset($article_form->image['key']) 
                            @if (\Storage::disk('s3')->exists($article_form->image['key'])) 
                                @php $image = \Storage::disk('s3')->url($article_form->image['key']); @endphp
                            @endif 
                        @endisset 

                        <img class="h-16 rounded-full" src="{{ $image }}" />
                    </div>

                    <div>
                        <label class="block pb-2" for="article_form_upload">{{ __('admin/article.image') }}</label>
                        <input class="h-10 px-2 rounded-sm w-full" type="file" id="article_form_upload" wire:model.live="article_form.image_upload" />
                        @error('article_form.image') <span class="error text-xs text-red-500" id="errorImage">{{ $message }}</span> @enderror
                        @error('article_form.image_upload') <span class="error text-xs text-red-500" id="errorImageUpload">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>

            <div class="md:col-span-4 flex gap-4 items-center justify-end lg:col-span-4 w-full">
                <a class="bg-neutral-300 border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-400" href="{{ route('admin.article.listing') }}">{{ __('Cancelar') }}</a>
                <button class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" type="submit" wire:loading.attr="disabled">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>
</div>
