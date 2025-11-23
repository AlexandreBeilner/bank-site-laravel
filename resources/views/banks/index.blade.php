@extends('layouts.app')

@section('title', 'Bancos')
@section('page_title', 'Bancos')

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

        <a href="{{ route('banks.create') }}"
           class="bg-orange-500 text-black text-sm px-3 py-2 rounded-md font-medium hover:bg-orange-600">
            Novo Banco
        </a>
    </div>

    @php
        $currentOrder = request('order_by', 'name');
        $currentDir   = request('direction', 'asc');

        $nameDir  = $currentOrder === 'name'  && $currentDir === 'asc' ? 'desc' : 'asc';
        $codeDir = $currentOrder === 'code' && $currentDir === 'asc' ? 'desc' : 'asc';
        $interestRateDir = $currentOrder === 'interest_rate' && $currentDir === 'asc' ? 'desc' : 'asc';
    @endphp

    <div class="bg-slate-950/80 border border-slate-800 rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-orange-500 text-black">
            <tr>
                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'name', 'direction' => $nameDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Nome
                        @if($currentOrder === 'name')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>

                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'code', 'direction' => $codeDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Código
                        @if($currentOrder === 'code')
                            @if($currentDir === 'asc')
                                <span class="text-xs">▲</span>
                            @else
                                <span class="text-xs">▼</span>
                            @endif
                        @endif
                    </a>
                </th>

                <th class="text-left px-4 py-2 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['order_by' => 'interest_rate', 'direction' => $interestRateDir, 'page' => 1]) }}"
                       class="flex items-center gap-1">
                        Percentual de Juros
                        @if($currentOrder === 'interest_rate')
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
            @forelse ($banks as $bank)
                <tr class="hover:bg-slate-900/70">
                    <td class="px-4 py-2">{{ $bank->name }}</td>
                    <td class="px-4 py-2">{{ $bank->code }}</td>
                    <td class="px-4 py-2">{{ $bank->interest_rate }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('banks.edit', $bank) }}"
                           class="text-orange-400 text-xs mr-3 hover:text-orange-300">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('banks.destroy', $bank) }}" class="inline">
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
                        Nenhum banco encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $banks->links() }}
    </div>

@endsection
