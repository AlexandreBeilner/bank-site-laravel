@extends('layouts.app')

@section('title', 'Boletos')
@section('page_title', 'Boletos')

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

        <a href="{{ route('billets.create') }}"
           class="bg-orange-500 text-black text-sm px-3 py-2 rounded-md font-medium hover:bg-orange-600">
            Novo Boleto
        </a>
    </div>

    @php
        $currentOrder = request('order_by', 'payer_name');
        $currentDir   = request('direction', 'asc');

        $payerNameDir  = $currentOrder === 'payer_name'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $payerDocumentDir  = $currentOrder === 'payer_document'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $recipientNameDir  = $currentOrder === 'recipient_name'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $recipientDocumentDir  = $currentOrder === 'recipient_document'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $amountDir  = $currentOrder === 'amount'  && $currentDir === 'asc' ? 'desc' : 'asc';
    @endphp

    <div class="bg-slate-950/80 border border-slate-800 rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-orange-500 text-black">
            <tr>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'payer_name', 'direction' => $payerNameDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Nome do Pagador
                        @if($currentOrder === 'payer_name')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'payer_document', 'direction' => $payerDocumentDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        CPF/CNPJ do Pagado
                        @if($currentOrder === 'payer_document')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'recipient_name', 'direction' => $recipientNameDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Nome do Beneficiário
                        @if($currentOrder === 'recipient_name')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'recipient_document', 'direction' => $recipientDocumentDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        CPF/CNPJ do Beneficiário
                        @if($currentOrder === 'recipient_document')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'amount', 'direction' => $amountDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Valor
                        @if($currentOrder === 'amount')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>

                <th class="text-right px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
            @forelse ($billets as $billet)
                <tr class="hover:bg-slate-900/70">
                    <td class="px-4 py-2">{{ $billet->payer_name }}</td>
                    <td class="px-4 py-2">{{ $billet->payer_document }}</td>
                    <td class="px-4 py-2">{{ $billet->recipient_name }}</td>
                    <td class="px-4 py-2">{{ $billet->recipient_document }}</td>
                    <td class="px-4 py-2">{{ $billet->amount }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('billets.edit', $billet) }}"
                           class="text-orange-400 text-xs mr-3 hover:text-orange-300">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('billets.destroy', $billet) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-400 text-xs hover:text-red-300 cursor-pointer">
                                Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-slate-500">
                        Nenhum boleto encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $billets->links() }}
    </div>

@endsection
