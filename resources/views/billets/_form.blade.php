@props([
    'action',
    'method' => 'POST',
    'billet' => null,
    'submitLabel' => 'Salvar',
])

<form method="POST" action="{{ $action }}" class="space-y-4 max-w-xl">
    @csrf

    @if (in_array($method, ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="name">
            Name
        </label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $billet->name ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('name')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="code">
            Percentual de Juros
        </label>
        <input
            id="interest_rate"
            name="interest_rate"
            type="number"
            min="0"
            max="99.9999"
            step="0.000001"
            value="{{ old('code', $billet->interest_rate ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('interest_rate')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end gap-2 pt-2">
        <a href="{{ route('billets.index') }}"
           class="px-3 py-2 text-sm rounded-md border border-slate-600 text-slate-200 hover:bg-slate-800">
            Cancelar
        </a>

        <button
            type="submit"
            class="px-4 py-2 text-sm font-semibold rounded-md bg-orange-500 text-black hover:bg-orange-600"
        >
            {{ $submitLabel }}
        </button>
    </div>
</form>
