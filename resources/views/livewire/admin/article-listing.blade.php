<div>
    <h1 class="border-b border-neutral-300 font-semibold mb-4 px-2 py-4 text-lg">{{ __('Articulo') }}</h1>

    <div class="flex items-center justify-end mb-4">
        <a class="button-primary border font-bold inline-block mb-2 ml-full mr-0 px-4 py-2 rounded text-slate-100" href="{{ route('admin.article.create') }}">{{ __('Crear') }}</a>
    </div>

    <x-table :data="$article" :headers="\App\Models\Article::$headers" editRoute="admin.article.edit" />
</div>
