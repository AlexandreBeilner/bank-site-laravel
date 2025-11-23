@extends('layouts.app')

@section('title', 'Serviço de cobrança')
@section('page_title', 'Serviço de cobrança')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <form method="GET" class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar..."
                class="border border-slate-300 rounded px-2 py-1 text-sm"
            >
            <button
                type="submit"
                class="bg-orange-500 text-black text-sm px-3 py-1 rounded"
            >
                Buscar
            </button>
        </form>

        <a href="{{ route('billings.create') }}"
           class="bg-orange-500 text-black text-sm px-3 py-2 rounded-md font-medium hover:bg-orange-600">
            Novo Serviço de Cobrança
        </a>
    </div>

    @php
        $currentOrder = request('order_by', 'description');
        $currentDir   = request('direction', 'asc');

        $descriptionDir  = $currentOrder === 'description'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $customerIdDir  = $currentOrder === 'customer_id'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $bankIdDir  = $currentOrder === 'bank_id'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $totalAmountDir  = $currentOrder === 'total_amount'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $installmentsDir  = $currentOrder === 'installments'  && $currentDir === 'asc' ? 'desc' : 'asc';
    @endphp

    <div class="bg-slate-950/80 border border-slate-800 rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-orange-500 text-black">
            <tr>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'description', 'direction' => $descriptionDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Descrição
                        @if($currentOrder === 'description')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'customer_id', 'direction' => $customerIdDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        ID do cliente
                        @if($currentOrder === 'customer_id')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'bank_id', 'direction' => $bankIdDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        ID do banco
                        @if($currentOrder === 'bank_id')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'total_amount', 'direction' => $totalAmountDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Valor total
                        @if($currentOrder === 'total_amount')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'installments', 'direction' => $installmentsDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Parcelas
                        @if($currentOrder === 'installments')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
            @forelse ($billings as $billing)
                <tr class="hover:bg-slate-900/70">
                    <td class="px-4 py-2">{{ $billing->description }}</td>
                    <td class="px-4 py-2">{{ $billing->customer_id }}</td>
                    <td class="px-4 py-2">{{ $billing->bank_id }}</td>
                    <td class="px-4 py-2">{{ $billing->total_amount }}</td>
                    <td class="px-4 py-2">{{ $billing->installments }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-slate-500">
                        Nenhum serviço de cobrança encontrado encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $billings->links() }}
    </div>

@endsection
