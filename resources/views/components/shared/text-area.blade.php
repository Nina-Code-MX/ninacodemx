@props(['id', 'label', 'name', 'placeholder', 'required' => false, 'rows' => 10, 'selected' => null, 'value' => ''])
<div {{ $attributes->merge(['class' => ''])->only(['class']) }} id="{{ $id }}Container">
    <label class="font-semibold sr-only">{{ $label }}</label>
    <textarea class="border-gray-300 px-2 py-1 rounded w-full" id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} rows="{{ $rows }}" wire:defer="{{ $name }}">{!! $selected !!}</textarea>
    <span class="bold text-xs text-red-500">@if($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>