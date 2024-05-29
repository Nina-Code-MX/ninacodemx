<div>
    {{ $data->links() }}
    <p></p>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="bg-neutral-50 font-light min-w-full text-left text-sm text-surface">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th scope="col" class="break-keep px-6 py-4 whitespace-nowrap">Actions</th>
                                @foreach ($headers as $h)
                                <th scope="col" class="break-keep px-6 py-4 whitespace-nowrap">{{ $h }}</th>
                                @endforeach 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d) 
                                @php $dd = $d->toArray(); @endphp
                            <tr class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-600">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <button class="btn-action relative z-0"><span class="material-symbols-outlined">more_vert</span></button>
                                    <div class="absolute action-menu bg-white hidden mt-2 py-0 rounded shadow-md w-48 z-10">
                                        <a href="{{ route($editRoute, ['model' => $dd['id']]) }}" class="flex gap-4 hover:bg-gray-200 items-center px-4 py-2 text-gray-800"><span class="material-symbols-outlined">edit</span><span>Edit</span></a>
                                        <a href="javascript:void(0)" class="flex gap-4 hover:bg-gray-200 items-center px-4 py-2 text-red-600" wire:click="delete('{{ $dd['id'] }}')" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"><span class="material-symbols-outlined">delete</span><span>Delete</span></a>
                                    </div>            
                                </td>
                                @foreach ($dd as $key => $data_info) 
                                    @if (!array_key_exists($key, $headers)) 
                                        @continue
                                    @endif
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($key === 'image') 
                                        @php $image = asset('images/logo-ninacode-mx-1024.png'); @endphp 

                                        @isset($data_info['key']) 
                                            @if (\Storage::disk('s3')->exists($data_info['key'])) 
                                                @php $image = \Storage::disk('s3')->temporaryUrl($data_info['key'], \Carbon\Carbon::now()->addMinutes(5)); @endphp
                                            @endif 
                                        @endisset 

                                    <img class="h-10 rounded-full" src="{{ $image }}" />
                                    @else 
                                        @if (is_array($data_info)) 
                                    <pre class="text-xs text-left">{{ json_encode($data_info, JSON_PRETTY_PRINT) }}</pre>
                                        @else 
                                    {{ $data_info ?? '-' }} 
                                        @endif 
                                    @endif 
                                </td>
                                @endforeach 
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p></p>
    {{ $data->links() }}
</div>