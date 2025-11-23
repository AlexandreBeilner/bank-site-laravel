@extends('layouts.app')

@section('title', 'Novo Serviço de cobrança')
@section('page_title', 'Novo Serviço de cobrança')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Criar Novo Serviço de cobrança
        </h2>

        <form method="POST" action="{{route('billings.store')}}" class="space-y-4 max-w-xl">
            @csrf
            @method('POST')

            <div>
                <label class="block text-sm font-medium text-slate-200 mb-1" for="description">
                    Descrição
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >{{ old('description', $billing->description ?? '') }}</textarea>
                @error('description')
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
                            @selected(old('customer_id', $billing->customer_id ?? '') == $customer->id)
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
                            @selected(old('bank_id', $billing->bank_id ?? '') == $bank->id)
                        >
                            {{ $bank->name }}
                        </option>
                    @endforeach
                </select>
                @error('bank_id')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-200 mb-1" for="total_amount">
                    Valor total
                </label>
                <input
                    id="total_amount"
                    name="total_amount"
                    type="number"
                    step="0.01"
                    min="0"
                    value="{{ old('total_amount', $billing->total_amount ?? '') }}"
                    class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >
                @error('total_amount')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-200 mb-1" for="installments">
                    Total de parcelas
                </label>
                <input
                    id="installments"
                    name="installments"
                    type="number"
                    min="1"
                    max="12"
                    value="{{ old('installments', $billing->installments ?? '') }}"
                    class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >
                @error('installments')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-200 mb-1" for="first_due_date">
                    Primeira data de vencimento
                </label>
                <input
                    id="first_due_date"
                    name="first_due_date"
                    type="date"
                    value="{{ old('first_due_date', isset($billing) && $billing->first_due_date ? $billing->first_due_date->format('Y-m-d') : '') }}"
                    class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
                   focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >
                @error('first_due_date')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-200 mb-1" for="periodicity">
                    Periodicidade
                </label>
                <select
                    id="periodicity"
                    name="periodicity"
                    class="w-full rounded-md border border-slate-700 bg-slate-900 text-slate-100 px-3 py-2 text-sm
               focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >
                    <option value="">Selecione a periodicidade</option>
                    <option value="monthly"
                        @selected(old('periodicity', $billing->periodicity ?? '') === 'monthly')
                    >
                        Mensalmente
                    </option>
                    <option value="weekly"
                        @selected(old('periodicity', $billing->periodicity ?? '') === 'weekly')
                    >
                        Semanalmente
                    </option>
                    <option value="daily"
                        @selected(old('periodicity', $billing->periodicity ?? '') === 'daily')
                    >
                        Diariamente
                    </option>
                </select>
                @error('periodicity')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex items-center justify-end gap-2 pt-2">
                <a href="{{ route('billings.index') }}"
                   class="px-3 py-2 text-sm rounded-md border border-slate-600 text-slate-200 hover:bg-slate-800">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-semibold rounded-md bg-orange-500 text-black hover:bg-orange-600"
                >
                    Criar
                </button>
            </div>
        </form>
    </div>
@endsection


