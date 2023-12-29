@props(['data' => [], 'id', 'label', 'name', 'placeholder', 'required' => false, 'value' => ''])
<div {{ $attributes->merge(['class' => ''])->only(['class']) }} id="{{ $id }}Container">
    <label class="font-semibold sr-only">{{ $label }}</label>
    <select class="border-gray-300 px-2 py-1 rounded w-full" id="{{ $id }}" name="{{ $id }}" {{ $required ? 'required' : '' }} wire:defer="{{ $name }}">
        <option value="">== {{ $placeholder }}</option>
        @foreach ($data AS $d)
        <option value="{{ $d['id'] }}">{{ $d['value'] }}</option>
        @endforeach 
    </select>
    <span class="bold text-xs text-red-500">@if($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>