@php $lang = \Cookie::get('lang') ?: config('app.locale'); @endphp 
@php $lang_available = config('app.locale_available') ?? ['es' => 'Español']; @endphp 
@php $lang_codes = config('app.locale_codes') ?? ['es' => 'mx']; @endphp 
<div>
    <section class="grid md:p-16 min-h-screen place-items-center p-2">
        <div class="w-72 rounded-md p-4 pt-0 bg-white shadow-lg">
            <header class="flex h-16 items-center justify-between font-bold">
                <span>Login</span>
                <!-- SVG: xmark -->
                <a class="hover:text-neutral-50" href="{{ route('home', ['locale' => $lang]) }}"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg></a>
                <!-- SVG: xmark -->
            </header>

            <form class="grid gap-3" wire:submit="loginin" onsubmit="return false;">
                <!-- Username Input -->
                <input class="h-10 rounded-sm px-2 focus:outline-none focus:ring" type="text" placeholder="Enter your username" wire:model="user.email" wire:loading.attr="disabled" />
                @error('user.email') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                <!-- Password Input -->
                <input class="h-10 rounded-sm px-2 focus:outline-none focus:ring" type="password" placeholder="Enter your password" wire:model="user.password" wire:loading.attr="disabled" />
                @error('user.password') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                <!-- Sign In Button -->
                <button class="flex h-10 items-center justify-between rounded-sm px-2 transition-colors duration-300 focus:outline-none focus:ring" type="submit" wire:loading.attr="disabled">
                    <span>Sign In</span>
                    <span>
                        <!-- SVG: chevron-right -->
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        <!-- SVG: chevron-right -->
                    </span>
                </button>
            </form>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    });

    document.addEventListener('livewire:initialized', () => {
        let $livewire = Livewire.first();

        document.querySelectorAll('input').forEach((input) => {
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    $livewire.loginin();
                }
            });
        });
    })
</script>
@endpush
