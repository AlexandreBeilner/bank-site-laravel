@props([
    'action',
    'method' => 'POST',
    'customer' => null,
    'submitLabel' => 'Save',
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
            value="{{ old('name', $customer->name ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('name')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="email">
            Email
        </label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $customer->email ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('email')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end gap-2 pt-2">
        <a href="{{ route('customers.index') }}"
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
