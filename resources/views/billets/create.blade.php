@extends('layouts.app')

@section('title', 'Novo Boleto')
@section('page_title', 'Novo Boleto')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Criar Novo Boleto
        </h2>

        @include('billets._form', [
            'action' => route('billets.store'),
            'method' => 'POST',
            'billet' => null,
            'submitLabel' => 'Criar',
        ])
    </div>
@endsection
