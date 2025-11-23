@extends('layouts.app')

@section('title', 'Editar Banco')
@section('page_title', 'Editar Banco')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Editar Banco
        </h2>

        @include('banks._form', [
            'action' => route('banks.update', $bank),
            'method' => 'PUT',
            'bank' => $bank,
            'submitLabel' => 'Salvar',
        ])
    </div>
@endsection
