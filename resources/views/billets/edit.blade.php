@extends('layouts.app')

@section('title', 'Editar Boleto')
@section('page_title', 'Editar Boleto')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Editar Boleto
        </h2>

        @include('billets._form', [
            'action' => route('billets.update', $billet),
            'method' => 'PUT',
            'billet' => $billet,
            'submitLabel' => 'Salvar',
        ])
    </div>
@endsection
