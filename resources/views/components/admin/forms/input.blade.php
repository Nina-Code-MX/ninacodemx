<div {{ $attributes->merge(['class' => 'md:col-span-2 lg:col-span-1 w-full'])->only(['class']); }}>
    <label class="block pb-2" {{ $attributes->only(['id']) }}>{{ $attributes->get('label') }}</label>
    <input class="h-10 px-2 rounded-sm w-full" {{ $attributes->except(['class', 'label', 'model']) }} />
    @error($attributes->only(['model'])) <span class="error text-xs text-red-500" id="error{{ $attributes->only(['model']) }}">{{ $message }}</span> @enderror 
</div>