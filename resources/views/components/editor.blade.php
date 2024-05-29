<div
    x-data="{
        content: @entangle($attributes->wire('model')),
        ...setupEditor()
    }"
    x-init="() => init($refs.editor)"
    wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
  <div x-ref="editor"></div>
</div>
