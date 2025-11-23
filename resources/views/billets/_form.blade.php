@props([
    'action',
    'method' => 'POST',
    'billet' => null,
    'submitLabel' => 'Salvar',
    'customers' => [],
    'banks' => [],
])

<form method="POST" action="{{ $action }}" class="space-y-4 max-w-xl">
    @csrf

    @if (in_array($method, ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="payer_name">
            Nome do Pagador
        </label>
        <input
            id="payer_name"
            name="payer_name"
            type="text"
            value="{{ old('payer_name', $billet->payer_name ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('payer_name')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="payer_document">
            CPF/CNPJ do Pagador
        </label>
        <input
            id="payer_document"
            name="payer_document"
            type="text"
            value="{{ old('payer_document', $billet->payer_document ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('payer_document')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="recipient_name">
            Nome do Beneficiário
        </label>
        <input
            id="recipient_name"
            name="recipient_name"
            type="text"
            value="{{ old('recipient_name', $billet->recipient_name ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('recipient_name')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="recipient_document">
            CPF/CNPJ do Beneficiário
        </label>
        <input
            id="recipient_document"
            name="recipient_document"
            type="text"
            value="{{ old('recipient_document', $billet->recipient_document ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('recipient_document')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="amount">
            Valor
        </label>
        <input
            id="amount"
            name="amount"
            type="number"
            step="0.01"
            min="0"
            value="{{ old('amount', $billet->amount ?? '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('amount')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="expiration_date">
            Data de Vencimento
        </label>
        <input
            id="expiration_date"
            name="expiration_date"
            type="date"
            value="{{ old('expiration_date', isset($billet) && $billet->expiration_date ? $billet->expiration_date->format('Y-m-d') : '') }}"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
        @error('expiration_date')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="observations">
            Observações
        </label>
        <textarea
            id="observations"
            name="observations"
            rows="3"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >{{ old('observations', $billet->observations ?? '') }}</textarea>
        @error('observations')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="customer_id">
            Cliente
        </label>
        <select
            id="customer_id"
            name="customer_id"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
            <option value="">Selecione um cliente</option>
            @foreach ($customers as $customer)
                <option
                    value="{{ $customer->id }}"
                    @selected(old('customer_id', $billet->customer_id ?? '') == $customer->id)
                >
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')
        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-200 mb-1" for="bank_id">
            Banco
        </label>
        <select
            id="bank_id"
            name="bank_id"
            class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
            <option value="">Selecione um banco</option>
            @foreach ($banks as $bank)
                <option
                    value="{{ $bank->id }}"
                    @selected(old('bank_id', $billet->bank_id ?? '') == $bank->id)
                >
                    {{ $bank->name }}
                </option>
            @endforeach
        </select>
        @error('bank_id')
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
